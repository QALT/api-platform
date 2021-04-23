Feature: applications

    Scenario: Fetch tags without authorization token
        When I request "GET" "/api/tags"
        Then the response status code should be "401"

    Scenario: Fetch tags with authorization token
        When I am logged as "admin"
        When I request "GET" "/api/tags"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"
        Then I am logged out

    Scenario: Fetch single tag with authorization token
        When I am logged as "admin"
        When I request "GET" "/api/tags/{tag_1}"
        Then the response status code should be "200"
        Then the response should contain key "id"
        Then I am logged out

    Scenario: Fetch non existing tag with authorization token
        When I am logged as "admin"
        When I request "GET" "/api/applications/abc"
        Then the response status code should be "404"
        Then I am logged out

    Scenario: Create tag as admin
        When I am logged as "admin"
        Given I have the Payload
        """
        {
            "label": "Pawnee"
        }
        """
        When I request "POST" "/api/tags"
        Then the response status code should be "201"
        Then the response should contain key "label" with value "Pawnee"
        Then the response should contain key "id"
        Then I am logged out

    Scenario: Create tag as employer
        When I am logged as "employer1"
        Given I have the Payload
        """
        {
            "label": "Pawnee"
        }
        """
        When I request "POST" "/api/tags"
        Then the response status code should be "403"
        Then I am logged out

    Scenario: Should not create tag with bad params
        When I am logged as "admin"
        Given I have the Payload
        """
        {
            "unkown": "Damn"
        }
        """
        When I request "POST" "/api/tags"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Should edit tag
        When I am logged as "admin"
        Given I have the Payload
        """
        {
            "label": "Ron Swanson"
        }
        """
        When I request "PUT" "/api/tags/{tag_1}"
        Then the response status code should be "200"
        Then the response should contain key "label" with value "Ron Swanson"
        Then I am logged out

    Scenario: Employee cannot change tag label
        When I am logged as "employee1"
        Given I have the Payload
        """
        {
            "label": "Bad companies"
        }
        """
        When I request "PUT" "/api/tags/{tag_1}"
        Then the response status code should be "403"

    Scenario: Admin can delete application
        When I am logged as "admin"
        When I request "DELETE" "/api/tags/{tag_1}"
        Then the response status code should be "204"
        When I request "GET" "/api/tags/{tag_1}"
        Then the response status code should be "404"
        Then I am logged out

    Scenario: Employee cannot delete tag
        When I am logged as "admin"
        When I request "DELETE" "/api/tags/{tag_1}"
        Then the response status code should be "403"
        Then I am logged out
