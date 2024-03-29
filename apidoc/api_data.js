define({ "api": [
  {
    "type": "post",
    "url": "get_crm_detail_post",
    "title": "Get CRM Details.",
    "description": "<p>Fetch CRM details using slug name</p>",
    "name": "get_crm_detail_post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "slug",
            "description": "<p>Slug</p>"
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
            "field": "Id",
            "description": "<p>CRM Id</p>"
          },
          {
            "group": "Success 200",
            "type": "varchar",
            "optional": false,
            "field": "CRM",
            "description": "<p>Title</p>"
          },
          {
            "group": "Success 200",
            "type": "text",
            "optional": false,
            "field": "CRMContent",
            "description": ""
          }
        ]
      }
    },
    "group": "CRM",
    "version": "0.0.0",
    "filename": "application/controllers/api/v1/Api.php",
    "groupTitle": "CRM"
  },
  {
    "type": "post",
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
    "type": "post",
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
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "hrms_id",
            "description": "<p>hrms id of user</p>"
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
            "field": "id",
            "description": "<p>Customer ID</p>"
          },
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
            "description": "<p>((previous_balance-current_balance)/previous_balance)*100</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "PhoneNumber",
            "description": "<p>Contact Number</p>"
          },
          {
            "group": "Success 200",
            "type": "date",
            "optional": false,
            "field": "CallDate",
            "description": "<p>Retrun If call date is present</p>"
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
    "type": "post",
    "url": "customer_retention_detail",
    "title": "Customer retention Details.",
    "description": "<p>Display the customer retention information of given customer id</p>",
    "name": "getCustomerRetentionDetail",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "customer_id",
            "description": "<p>Customer ID</p>"
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
            "field": "customer_name",
            "description": "<p>customer name</p>"
          },
          {
            "group": "Success 200",
            "type": "date",
            "optional": false,
            "field": "CallDate",
            "description": "<p>Retrun If call date is present</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "contact_no",
            "description": "<p>Phone Number</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Customer Retention Id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "customer_id",
            "description": "<p>Customer ID</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "internet_banking",
            "description": "<p>Yes/No</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "mobile_banking",
            "description": "<p>Yes/No</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "debit_card",
            "description": "<p>Yes/No</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "neft_rtgs",
            "description": "<p>Yes/No</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "moving_money_dena_to_non_dena",
            "description": "<p>Yes/No</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "remarks",
            "description": "<p>Customer Remark</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "three_months_internet_transaction",
            "description": "<p>Internet Transactions</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "three_months_mobile_transaction",
            "description": "<p>Mobile Transactions</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "transaction_debit_card_POS",
            "description": "<p>Debit Card Transactions</p>"
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
    "type": "post",
    "url": "customer_retention_remark_update",
    "title": "Customer retention Remark Update.",
    "description": "<p>Update the remark for the given customer id</p>",
    "name": "updateRemark",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "customer_id",
            "description": "<p>Customer ID</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "remark",
            "description": "<p>contents</p>"
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
            "field": "contact_no",
            "description": "<p>Phone Number</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Customer Retention Id</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "customer_id",
            "description": "<p>Customer ID</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "internet_banking",
            "description": "<p>yes/no</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "mobile_banking",
            "description": "<p>yes/no</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "debit_card",
            "description": "<p>yes/no</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "neft_rtgs",
            "description": "<p>yes/no</p>"
          },
          {
            "group": "Success 200",
            "type": "boolean",
            "optional": false,
            "field": "moving_money_dena_to_non_dena",
            "description": "<p>yes/no</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "remarks",
            "description": "<p>Customer Remark</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "three_months_internet_transaction",
            "description": "<p>Internet Transactions</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "three_months_mobile_transaction",
            "description": "<p>Mobile Transactions</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "transaction_debit_card_POS",
            "description": "<p>Debit Card Transactions</p>"
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
