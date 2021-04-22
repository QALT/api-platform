Feature: users
    # Background:
    #     Given The fixtures file "User" is loaded
    #     Given The fixtures files
    #     | Address |
    #     | User |

    Scenario: Fetch users without authorization token
        When I request "GET" "/api/users"
        Then the response status code should be "401"

    Scenario: Fetch users with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/users"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"

    Scenario: Register new user
        Given I have The Payload
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
        Then the response should contain key "email" with value "test@gmail.com"
        Then I add a reference "user"
        When I am logged as "admin"
        When I request "GET" "/api/users/{user.@id}"
        Then the response status code should be "200"
        Then the response should contain key "email" with value "test@gmail.com"
        Then I am logged out