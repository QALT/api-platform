Feature: users
    Scenario: Fetch users without authorization token
        When I request "GET" "/api/users"
        Then the response status code should be "401"

    Scenario: Update user without authorization token
        When I request "PUT" "/api/users/1"
        Then the response status code should be "401"

    Scenario: Delete user without authorization token
        When I request "DELETE" "/api/users/1"
        Then the response status code should be "401"

    Scenario: Fetch users with authorization token
        When I am logged as "employee1"
        And I request "GET" "/api/users"
        Then the response status code should be "200"
        And the response should contain key "hydra:member[0]"
        And I am logged out

    Scenario: Register new user
        Given I have the Payload
        """
        {
            "email": "test@gmail.com",
            "password": "Password",
            "owner": "/api/users/{user_employee_1}"
        }
        """
        When I request "POST" "/api/users"
        Then the response status code should be "201"
        And the response should contain key "id"
        And the response should not contain key "password"
        And I add a reference "user"
        When I am logged as "admin"
        And I request "GET" "/api/users/{user}"
        Then the response status code should be "200"
        And the response should contain key "email" with value "test@gmail.com"
        And I am logged out

    Scenario: Update a user when not admin and not himself
        Given I have the payload
        """
        {
            "email": "toto@gmail.com"
        }
        """
        When I am logged as "employee1"
        And I request "PUT" "/api/users/{user_employee_2}"
        Then the response status code should be "403"
        And I am logged out

    Scenario: Update a user when himself
        Given I have the payload
        """
        {
            "email": "toto@gmail.com"
        }
        """
        When I am logged as "employee2"
        And I request "PUT" "/api/users/{user_employee_2}"
        Then the response status code should be "200"
        And the response should contain key "email" with value "toto@gmail.com"
        And I am logged out

    Scenario: Update a user when admin and not himself
        Given I have the payload
        """
        {
            "email": "titi@gmail.com"
        }
        """
        When I am logged as "admin"
        And I request "PUT" "/api/users/{user_employee_2}"
        Then the response status code should be "200"
        And the response should contain key "email" with value "titi@gmail.com"
        And I am logged out

    Scenario: Update a user when admin and himself
        Given I have the payload
        """
        {
            "email": "titi@gmail.com"
        }
        """
        When I am logged as "admin"
        And I request "PUT" "/api/users/{user_employee_2}"
        Then the response status code should be "200"
        And the response should contain key "email" with value "titi@gmail.com"
        And I am logged out

    Scenario: Delete a user when not admin and not himself
        When I am logged as "employee1"
        And I request "DELETE" "/api/users/{user_employee_2}"
        Then the response status code should be "403"
        And I am logged out

    Scenario: Delete a user when himself
        When I am logged as "employee1"
        And I request "DELETE" "/api/users/{user_employee_1}"
        Then the response status code should be "403"
        And I am logged out

    Scenario: Delete a user when admin and not himself
        When I am logged as "admin"
        And I request "DELETE" "/api/users/{user_employee_2}"
        Then the response status code should be "204"
        And I am logged out

    Scenario: Delete a user when admin and himself
        When I am logged as "admin"
        And I request "DELETE" "/api/users/{user_admin}"
        Then the response status code should be "204"
        And I am logged out
