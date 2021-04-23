Feature: studies
    Scenario: Fetch study without authorization token
        When I request "GET" "/api/offers"
        Then the response status code should be "401"
    
    Scenario: Fetch studies with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/studies"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"

    Scenario: Create studies without authorization token
        Given I have the Payload
        """
        {
            "email": "test@gmail.com",
            "password": "Password"
        }
        """
        When I request "POST" "/api/users"
        Then the response status code should be "201"
        Then the response should contain key "id"
        Then the response should not contain key "password"
        Then I add a reference "user"
        When I am logged as "admin"
        When I request "GET" "/api/users/{user}"
        Then the response status code should be "200"
        Then the response should contain key "email" with value "test@gmail.com"
        Then I am logged out