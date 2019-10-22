Feature: Car details
  In order to see car details
  As a website user
  I need to be able to see car details

  Scenario: See car details
    When I am on "/car/mark-10-model-10-2010"
    Then I should see "Cars"
    And I should see "ID"
    And I should see "Mark"
    And I should see "Model"
    And I should see "Year"
    And I should see "Description"
    And I should see "Last update"
    And I should see "Country"
    And I should see "City"
    And I should see "Enabled"
    And I should see "Photo"