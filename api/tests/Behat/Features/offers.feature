Feature: offers

    Scenario: Create offers while logged in
        Given I have the Payload
        """
        {
            "title": "Offre pour Behat",
            "description": "Réaliser des tests unitaires sur Behat",
            "tags": [
                {
                    "label": "PHP"
                },
                {
                    "label": "API-PLATFORM"
                }
            ]
        }
        """
        When I am logged as "employer1"
        When I request "POST" "/api/offers"
        Then the response status code should be "201"
        Then the response should contain key "id"
        Then the response should contain key "title"
        Then the response should contain key "description"
        Then I add a reference "offer"
        When I request "GET" "/api/offer/{offer.@id}"
        Then the response status code should be "200"
        Then the response should contain key "tags"
        Then the response should contain key "title" with value "Offre pour Behat"
        Then the response should contain key "description" with value "Réaliser des tests unitaires sur Behat"
        Then the response should contain key "tags[0].label" with value "PHP"
        Then the response should contain key "tags[1].label" with value "API-PLATFORM"
        Then I am logged out


    

