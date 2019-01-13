#!/bin/bash

STR="                  $*                  "
tput setaf 7

echo -e "**${STR//?/*}**
* ${STR//?/ } *
* $(tput sgr0)$(tput bold)$STR$(tput sgr0)$(tput setaf 7) *
* ${STR//?/ } *
**${STR//?/*}**"
tput sgr 0

exit 0
