# hipc_ccol_rss
Generates an RSS feed from CCOL scheduled programs.

###Requirements:
AWS Account

###Setup Instructions:

Rename settings-sample.py to settings.py and add in your CCOL api token, secret and organization id(s).

Create a zip file that includes all of the source files.

Create a new function on AWS Lambda with the zip file you created.

Attach an AWS API Gateway endpoint.  When configuring the endpoint, ensure the Integration Response mapping is configured to output the contents of the function directly.  Reference: http://stackoverflow.com/questions/33614198/return-html-from-aws-api-gateway



