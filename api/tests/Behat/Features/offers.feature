Feature: offers
    Scenario: Fetch offer without authorization token
        When I request "GET" "/api/offers"
        Then the response status code should be "401"
    
    Scenario: Fetch offers while logged in
        When I am logged as "employee1"
        When I request "GET" "/api/offers"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"
        Then I am logged out

    Scenario: Create offer without authorization token
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
        When I request "POST" "/api/offers"
        Then the response status code should be "401"

    Scenario: Create offer while logged in
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
        When I request "GET" "/api/offers/{offer}"
        Then the response status code should be "200"
        Then the response should contain key "tags"
        Then the response should contain key "title" with value "Offre pour Behat"
        Then the response should contain key "description" with value "Réaliser des tests unitaires sur Behat"
        Then the response should contain key "tags[0].label" with value "PHP"
        Then the response should contain key "tags[1].label" with value "API-PLATFORM"
        Then I am logged out
    
    Scenario: Update offer without authorization token
         Given I have the Payload
        """
        {
            "title": "Offre pour Behat"
        }
        """
        When I request "PUT" "/api/offers/{offer_1}"
        Then the response status code should be "401"

    Scenario: Update offer
        When I am logged as "employer1"
        Given I have the Payload
        """
        {
            "title": "Offre pour Behat"
        }
        """
        When I request "PUT" "/api/offers/{offer_1}"
        Then the response status code should be "200"
        When I request "GET" "/api/offers/{offer_1}"
        Then the response status code should be "200"
        Then the response should contain key "title" with value "Offre pour Behat"
        Then I am logged out

    Scenario: Delete offer without authorization token
        When I request "DELETE" "/api/offers/1"
        Then the response status code should be "401"
   
    Scenario: Delete offer
        When I am logged as "employer2"
        When I request "DELETE" "/api/offers/{offer_2}"
        Then the response status code should be "204"
        When I request "GET" "/api/offers/{offer_2}"
        Then the response status code should be "404"
        Then I am logged out



    

