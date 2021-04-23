Feature: studies
    Scenario: Fetch study without authorization token
        When I request "GET" "/api/studies"
        Then the response status code should be "401"
    
    Scenario: Fetch studies with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/studies"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"
        Then I am logged out
    
    Scenario: Fetch study without authorization token
        When I request "GET" "/api/studies/{study_1}"
        Then the response status code should be "401"
    
    Scenario: Fetch study with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/studies/{study_1}"
        Then the response status code should be "200"
        Then the response should contain key "label"
        Then the response should contain key "school"
        Then the response should contain key "degree"
        Then the response should contain key "userAccount"
        Then I am logged out

    Scenario: Delete study without authorization token
        When I request "DELETE" "/api/studies/1"
        Then the response status code should be "401"
    
    Scenario: Delete study with authorization token
        When I am logged as "employee1"
        When I request "DELETE" "/api/studies/{study_1}"
        Then the response status code should be "204"
        When I request "GET" "/api/studies/{study_1}"
        Then the response status code should be "404"
        Then I am logged out
    
    Scenario: Update study without authorization token
         Given I have the Payload
        """
        {
            "label": "Label Update From Behat"
        }
        """
        When I request "PUT" "/api/studies/{study_2}"
        Then the response status code should be "401"

    Scenario: Update study with authorization token
        Given I have the Payload
        """
        {
            "label": "Label Update From Behat"
        }
        """
        When I am logged as "employee1"
        When I request "PUT" "/api/studies/{study_2}"
        Then the response status code should be "200"
        When I request "GET" "/api/studies/{study_2}"
        Then the response status code should be "200"
        Then the response should contain key "label" with value "Label Update From Behat"
        Then I am logged out
    
    Scenario: Create studiy without authorization token
        Given I have the Payload
        """
        {
            "label": "Ingénierie du web",
            "school": "ESGI"
        }
        """
        When I request "POST" "/api/studies"
        Then the response status code should be "401"

    Scenario: Create study with authorization token
        Given I have the Payload
        """
        {
            "label": "Ingénierie du web",
            "school": "ESGI"
        }
        """
        When I am logged as "employee1"
        When I request "POST" "/api/studies"
        Then the response status code should be "201"
        Then the response should contain key "id"
        Then the response should contain key "label"
        Then the response should contain key "school"
        Then I add a reference "study"
        When I request "GET" "/api/studies/{study}"
        Then the response status code should be "200"
        Then I am logged out

        
