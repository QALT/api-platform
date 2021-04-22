Feature: degrees
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
    When I request "PUT" "/api/degrees/{degree.@id}"
    Then the response status code should be "200"
    Then the response should contain key "label" with value "Master 1"
    When I request "DELETE" "/api/degrees/{degree.@id}"
    Then the response status code should be "204"


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
    When I request "PUT" "/api/degrees/{degree.@id}"
    Then the response status code should be "200"
    Then the response should contain key "label" with value "Master 1"
    When I request "DELETE" "/api/degrees/{degree.@id}"
    Then the response status code should be "204"
