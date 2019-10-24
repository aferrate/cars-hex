Feature: Insert car
  In order to insert car
  As a website user
  I need to be able to insert car

  Scenario: Insert car
    Given the request body is:
      """
        {
          mark: 'mark behat',
          model: 'model behat',
          country: 'EEUU',
          city: 'Dallas',
          description: 'behat desc',
          year: 1999,
          enabled: 1
        }
      """
    When I request "/admin/car/new" using HTTP POST
    Then the response code is 200