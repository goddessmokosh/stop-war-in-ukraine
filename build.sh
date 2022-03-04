#!/bin/bash
#
# Automate the retrieval of project dependencies
#

#
# Bundle cmb for distribution as described at 
# https://github.com/CMB2/CMB2/wiki/Basic-Usage#caveats-for-bundling-and-including-cmb2
#
rm -rf ./includes/cmb2
mkdir ./includes
curl https://downloads.wordpress.org/plugin/cmb2.zip -L -o ./includes/cmb2.zip
unzip -o includes/cmb2.zip -d ./includes
rm ./includes/cmb2.zip
