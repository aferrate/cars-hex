Feature: Update car
  In order to update car
  As a website user
  I need to be able to update car

  Scenario: Update car
    Given the request body is:
      """
        {
          mark: 'mark 9',
          model: 'model 9',
          country: 'Spain',
          city: 'Barcelona',
          description: 'behat desc test',
          year: 1997,
          enabled: 0
        }
      """
    When I request "/admin/car/9/edit" using HTTP POST
    Then the response code is 200