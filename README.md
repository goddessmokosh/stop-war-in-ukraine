# Stop War in Ukraine

## What?
A WordPress plugin that displays proxied war news from the free world to Russian IP address visitors with option to block further access. This plugin will be submitted to the WordPress.org repo ASAP. All source code is available for review; and uses the [CMB2 open source project](https://cmb2.io/) for it's admin interface.

## Why?
Russian citizens are being [blocked from world news](https://en.wikipedia.org/wiki/Internet_censorship_in_Russia) in the free world. Many do not know what is happening in Ukraine; this plugin can safely circumvent that.

## How? 
When this plugin is activated, a user visiting from a Russian IP address will see an overlay on your website with an embedded iframe showing BBC news in the Russian language. A reduced bandwidth page is proxied through your server and domain name through an iframe; this allows a Russian user that cannot access news to see basic headlines and main headline images. They will also see a banner to the International Red Cross with a donation link in the Russian language and currency. Here is a screenshot of what they may see:

![screenshot](/screenshot.png?raw=true "Optional Title")

## Options
You can allow Russian visitors to dismiss the overlway or you can set the overlay to persist; inhibiting easy access to your website. To preserve SEO, your site still exists under the overlay. Other options allow you to omit the Red Cross banner and test the functionality by adding your IP address to the block list. **This plugin does not block access to your admin pages or login**. You can configure options in the WordPress Admin Menu for Settings -> Stop War In Ukraine

The list of IPs that are "blocked" are in the file titled [russian_ip_addresses.php](https://github.com/goddessmokosh/stop-war-in-ukraine/blob/main/russian_ip_addresses.php). The list is compiled to include both Russian and Belarus IP addresses in CIDR format from https://www.countryipblocks.net/acl.php
