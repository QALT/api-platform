Feature: addresses
    Scenario: Fetch addresses without authorization token
        When I request "GET" "/api/addresses"
        Then the response status code should be "401"

    Scenario: Fetch one address without authorization token
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "401"

    Scenario: Fetch one address that does not exist while logged in
        When I am logged as "admin"
        When I request "GET" "/api/addresses/0"
        Then the response status code should be "404"
        Then I am logged out

    Scenario: Fetch one address with authorization token while logged in
        When I am logged as "admin"
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        Then the response should contain key "country"
        Then the response should contain key "region"
        Then the response should contain key "postalCode"
        Then the response should contain key "town"
        Then the response should contain key "street"
        Then I am logged out

    Scenario: Fetch addresses with authorization token while logged in
        When I am logged as "admin"
        When I request "GET" "/api/addresses"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"
        Then I am logged out

    Scenario: Register new address while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "country": "France",
            "region": "Île-de-France",
            "postalCode": "75009",
            "town": "Paris",
            "street": "11 rue du conservatoire"
        }
        """
        When I request "POST" "/api/addresses"
        Then the response status code should be "201"
        Then the response should contain key "id"
        Then I am logged out

    Scenario: Register new address without country while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "region": "Île-de-France",
            "postalCode": "75009",
            "town": "Paris",
            "street": "11 rue du conservatoire"
        }
        """
        When I request "POST" "/api/addresses"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Register new address without region while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "country": "France",
            "postalCode": "75009",
            "town": "Paris",
            "street": "11 rue du conservatoire"
        }
        """
        When I request "POST" "/api/addresses"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Register new address without postal code while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "country": "France",
            "region": "Île-de-France",
            "town": "Paris",
            "street": "11 rue du conservatoire"
        }
        """
        When I request "POST" "/api/addresses"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Register new address without town while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "country": "France",
            "region": "Île-de-France",
            "postalCode": "75009",
            "street": "11 rue du conservatoire"
        }
        """
        When I request "POST" "/api/addresses"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Register new address without street while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "country": "France",
            "region": "Île-de-France",
            "postalCode": "75009",
            "town": "Paris"
        }
        """
        When I request "POST" "/api/addresses"
        Then the response status code should be "500"
        Then I am logged out

    Scenario: Update address country while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "country": "Country"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        And the response should contain key "country" with value "Country"
        And I am logged out

    Scenario: Update address region while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "region": "Région"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        And the response should contain key "region" with value "Région"
        And I am logged out

    Scenario: Update address postal code while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "postalCode": "12345"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        And the response should contain key "postalCode" with value "12345"
        And I am logged out

    Scenario: Update address street while logged in
        When I am logged as "employee1"
        Given I have The Payload
        """
        {
            "street": "StreetTriple"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "200"
        And the response should contain key "street" with value "StreetTriple"
        And I am logged out

    Scenario: Update address country while logged out
        Given I have The Payload
        """
        {
            "country": "Country"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "401"

    Scenario: Update address postal code while logged out
        Given I have The Payload
        """
        {
            "postalCode": "CodePostal"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "401"

    Scenario: Update address town while logged out
        Given I have The Payload
        """
        {
            "town": "Taoune"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "401"

    Scenario: Update address street while logged out
        Given I have The Payload
        """
        {
            "street": "StreetTriple"
        }
        """
        When I request "PUT" "/api/addresses/{address_1}"
        Then the response status code should be "401"

    Scenario: Delete one address while logged out
        When I request "DELETE" "/api/addresses/{address_1}"
        Then the response status code should be "401"

    Scenario: Delete one address while logged in
        When I am logged as "admin"
        When I request "DELETE" "/api/addresses/{address_1}"
        Then the response status code should be "204"
        When I request "GET" "/api/addresses/{address_1}"
        Then the response status code should be "404"
        And I am logged out
