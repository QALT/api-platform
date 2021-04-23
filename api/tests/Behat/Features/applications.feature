Feature: applications

    Scenario: Fetch applications without authorization token
        When I request "GET" "/api/applications"
        Then the response status code should be "401"

    Scenario: Fetch applications with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/applications"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"
        Then I am logged out

    Scenario: Fetch single application with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/applications/{application_1}"
        Then the response status code should be "200"
        Then the response should contain key "id"
        Then I am logged out
    
    Scenario: Fetch other employee application
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "status": "submitted",
            "comment": "application comment",
            "offer": "/api/offers/{offer_1}",
            "applicant": "/api/users/{user_employee_2}"
        }
        """
        When I request "POST" "/api/applications"
        Then the response status code should be "201"
        Then I add a reference "application_for_employee_2"
        When I request "GET" "/api/applications/{application_for_employee_2}"
        Then the response status code should be "403"
        Then I am logged out

    Scenario: Fetch non existing application with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/applications/abc"
        Then the response status code should be "404"
        Then I am logged out

    Scenario: Create application
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "status": "submitted",
            "comment": "application comment",
            "offer": "/api/offers/{offer_1}",
            "applicant": "/api/users/{user_employee_1}"
        }
        """
        When I request "POST" "/api/applications"
        Then the response status code should be "201"
        Then the response should contain key "status" with value "submitted"
        Then the response should contain key "comment" with value "application comment"
        Then I am logged out

    Scenario: Should not create application with bad body
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "status": "submitted",
            "comment": "application comment"
        }
        """
        When I request "POST" "/api/applications"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Should edit application
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "comment": "application comment edited"
        }
        """
        When I request "PUT" "/api/applications/{application_1}"
        Then the response status code should be "200"
        Then I am logged out

    Scenario: Employee cannot change application status
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "status": "accepted"
        }
        """
        When I request "PUT" "/api/applications/{application_1}"
        Then the response status code should be "403"

    Scenario: Employee cannot edit other applicant's applications
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "status": "submitted",
            "comment": "application comment",
            "offer": "/api/offers/{offer_1}",
            "applicant": "/api/users/{user_employee_2}"
        }
        """
        When I request "POST" "/api/applications"
        Then the response status code should be "201"
        Then I add a reference "application_for_employee_2"
        Given I have the Payload
        """
        {
            "comment": "Don't hire me"
        }
        """
        When I request "PUT" "/api/applications/{application_for_employee_2}"
        Then the response status code should be "403"
        Then I am logged out

    Scenario: Employee can delete application
        When I am logged as "employee1"
        When I request "DELETE" "/api/applications/{application_1}"
        Then the response status code should be "204"
        When I request "GET" "/api/applications/{application_1}"
        Then the response status code should be "404"
        Then I am logged out

    Scenario: Employee cannot delete other employee application
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "status": "submitted",
            "comment": "application comment",
            "offer": "/api/offers/{offer_1}",
            "applicant": "/api/users/{user_employee_2}"
        }
        """
        When I request "POST" "/api/applications"
        Then the response status code should be "201"
        Then I add a reference "application_for_employee_2"
        When I request "DELETE" "/api/applications/{application_for_employee_2}"
        Then the response status code should be "403"
        Then I am logged out
