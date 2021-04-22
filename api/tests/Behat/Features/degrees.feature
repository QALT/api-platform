Feature: degrees
    Scenario: Fetch degree without authorization token
        When I request "GET" "/api/degrees"
        Then the response status code should be "401"

    Scenario: Fetch degrees with authorization token
        When I am logged as "admin"
        When I request "GET" "/api/degrees"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"
        Then I am logged out

    Scenario: Update degree without authorization token
        When I request "PUT" "/api/degrees/1"
        Then the response status code should be "401"
    
    Scenario: Delete degree without authorization token
    When I request "DELETE" "/api/degrees/1"
    Then the response status code should be "401"

    Scenario: Create degree
    Given I have the Payload
        """
        {
            "label": "Master 2"
        }
        """
    When I am logged as "admin"
    When I request "POST" "/api/degrees"
    Then the response status code should be "201"
    Then the response should contain key "id"
    Then the response should contain key "label"
    Then I add a reference "degree"
    Given I have the Payload
        """
        {
            "label": "Master 1"
        }
        """
    When I request "PUT" "/api/degrees/{degree}"
    Then the response status code should be "200"
    Then the response should contain key "label" with value "Master 1"
    When I request "DELETE" "/api/degrees/{degree}"
    Then the response status code should be "204"
    Then I request "GET" "/api/degrees/{degree}"
    Then the response status code should be "404"
    Then I am logged out

    Scenario: Create degree with study
    Given I have the Payload
        """
        {
            "label": "Master 2"
        }
        """
    When I am logged as "admin"
    When I request "POST" "/api/degrees"
    Then the response status code should be "201"
    Then the response should contain key "id"
    Then the response should contain key "label"
    Then I add a reference "degree"
    Given I have the Payload
        """
        {
            "label": "Master 1"
        }
        """
    When I request "PUT" "/api/degrees/{degree}"
    Then the response status code should be "200"
    Then the response should contain key "label" with value "Master 1"
    When I request "DELETE" "/api/degrees/{degree}"
    Then the response status code should be "204"
    Then I am logged out