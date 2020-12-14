# showroom

1. Copy module's files to  app/code/BelVG/Showroom directory via FTP.
2. Run the next commands:

bin/magento maintenance:enable

php bin/magento module:enable BelVG_Showroom

php bin/magento setup:upgrade

bin/magento setup:di:compile

bin/magento setup:static-content:deploy

bin/magento maintenance:disable
