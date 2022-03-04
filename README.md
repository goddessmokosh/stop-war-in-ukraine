# Stop War in Ukraine

## What?
A WordPress plugin that displays an overlay with a Red Cross donation link and a live feed of war news *only to Russian* visitors. The overlay can be dismissed or set to block further access to the website. Since it's an overlay it does not prevent indexing on Yandex or other search engines. This plugin has been submitted to the WordPress.org repo (pending review). All source code is available for review; and uses the [CMB2 open source project](https://cmb2.io/) for it's admin interface. The overlay message is in Russian and says: "World news - This site is blocked in Russia ✚give to Ukraine, The Red Cross helps victims of the conflict in the east of the country, and also supports the work of the Red Cross Society of Ukraine".

## Why?
Russian citizens are being [blocked from world news](https://en.wikipedia.org/wiki/Internet_censorship_in_Russia) in the free world. Many do not know what is happening in Ukraine; this plugin can safely circumvent that by proxying BBC News in Russian. 

## How? 
When this plugin is activated, a user visiting from a Russian IP address will see an overlay on your website with an embedded iframe showing BBC news in the Russian language (proxied; even if BBC is banned in Russia, the news will appear through your website domain). A reduced bandwidth page is proxied through your server and domain name through an iframe; this allows a Russian user that cannot access news to see basic headlines and main headline images. They will also see a banner to the International Red Cross with a donation link in the Russian language and currency. Here is a screenshot of what they may see:

![screenshot](/screenshot.png?raw=true "Optional Title")


## Installation
Installation is simple. Just download the main repo here using the Download button (or https://github.com/goddessmokosh/stop-war-in-ukraine/archive/refs/heads/main.zip). Visit your WordPress dashboard, Plugins -> Add New -> Upload Plugin. You can configure options in the WordPress Admin Menu for Settings -> Stop War In Ukraine

## Options
You can allow Russian visitors to dismiss the overlay or you can set the overlay to persist; inhibiting easy access to your website. To preserve SEO, your site still exists under the overlay. Other options allow you to omit the Red Cross banner and test the functionality by adding your IP address to the block list. **This plugin does not block access to your website or its admin pages or login**. The overlay is **only displayed to Russian/Belarusian visitors**. Once activated, you can configure options in the WordPress Admin Menu for Settings -> Stop War In Ukraine

The list of IPs that are "blocked" are in the file titled [russian_ip_addresses.php](https://github.com/goddessmokosh/stop-war-in-ukraine/blob/main/russian_ip_addresses.php). The list is compiled to include both Russian and Belarus IP addresses in CIDR format from https://www.countryipblocks.net/acl.php
