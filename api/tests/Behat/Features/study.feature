Feature: studies
    Scenario: Fetch study without authorization token
        When I request "GET" "/api/offers"
        Then the response status code should be "401"
    
    Scenario: Fetch studies with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/studies"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"

    Scenario: Fetch studies with employee1
        When I am logged as "employee1"
        When I request "GET" "/api/studies?userAccount={user_auth}"
        Then the response status code should be "201"