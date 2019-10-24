Feature: Find car
  In order to find car
  As a website user
  I need to be able to find car

  Scenario: Find car
    Given the request body is:
      """
        {search: 'mark 9', field: 'mark'}
      """
    When I request "/car/search/filter" using HTTP POST
    Then the response code is 200

  Scenario: Find non existing car
    Given the request body is:
      """
        {search: 'mark 9999', field: 'mark'}
      """
    When I request "/car/search/filter" using HTTP POST
    Then the response code is 200