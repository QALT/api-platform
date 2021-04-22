Feature: users
    Scenario: Fetch users without authorization token
        When I request "GET" "/api/users"
        Then the response status code should be "401"

    Scenario: Update user without authorization token
        When I request "PUT" "/api/users/1"
        Then the response status code should be "401"

    Scenario: Delete user without authorization token
        When I request "DELETE" "/api/users/1"
        Then the response status code should be "401"

    Scenario: Fetch users with authorization token
        When I am logged as "employee1"
        When I request "GET" "/api/users"
        Then the response status code should be "200"
        Then the response should contain key "hydra:member[0]"

    Scenario: Register new user
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

    Scenario: Update a user when not admin and not himself
        When I am logged as "employee1"
        Given I have the payload
        """
        {
            "email": "toto@gmail.com"
        }
        """
        When I request "PUT" "/api/users/{user_employee_2}"
        Then the response status code should be "403"

    # Scenario: Update a user when himself

    # Scenario: Update a user when admin and not himself

    # Scenario: Update a user when admin and himself

    # Scenario: Delete a user when not admin and not himself

    # Scenario: Delete a user when himself

    # Scenario: Delete a user when admin and not himself

    # Scenario: Delete a user when admin and himself
