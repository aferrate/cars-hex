Feature: Mainpage
  In order to see cars
  As a website user
  I need to be able to see cars

  Scenario: See main cars
    When I am on "/"
    Then I should see "Cars"
    And I should see "ID"
    And I should see "Mark"
    And I should see "Model"
    And I should see "Year"
    And I should see "Last update"
    And I should see "Photo"