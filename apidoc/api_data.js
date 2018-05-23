define({ "api": [
  {
    "type": "get",
    "url": "customer_retention_lead",
    "title": "Count for the Total Lead and pending calls",
    "description": "<p>count total lead and pending</p>",
    "name": "getCustomerLead",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "hrms_id",
            "description": "<p>hrms id of the customer</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "total",
            "description": "<p>count</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "pending",
            "description": "<p>count</p>"
          }
        ]
      }
    },
    "group": "Customer_Retention",
    "version": "0.0.0",
    "filename": "application/controllers/api/v1/Api.php",
    "groupTitle": "Customer_Retention"
  },
  {
    "type": "get",
    "url": "customer_retention_list",
    "title": "Customer retention Called and Pending list.",
    "description": "<p>list customer retention depend on the page number and list(pending or called)</p>",
    "name": "getCustomerList",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "list",
            "description": "<p>Either called or pending</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>current page number</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "customer",
            "description": "<p>customer name</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "BalanceDrop",
            "description": "<p>current_balance</p>"
          }
        ]
      }
    },
    "group": "Customer_Retention",
    "version": "0.0.0",
    "filename": "application/controllers/api/v1/Api.php",
    "groupTitle": "Customer_Retention"
  }
] });
