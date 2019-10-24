Feature: Delete car
  In order to delete car
  As a website user
  I need to be able to delete car

  Scenario: Delete non existing car
    Given the request body is:
      """
        {
          carid: 999
        }
      """
    When I request "/admin/car/delete" using HTTP POST
    Then the response code is 500