#!/bin/bash

# Get input
echo Enter list on one line, seperated by semi-colon, followed by ENTER and CTR-D:
OIFS=$IFS
IFS=";"
input=$(cat)

# Remove space and sort
list=($(echo $input | sed -e "s/^[ ]*//g" -e "s/[ ]*$//g" | sort | tr '\n' ';'))

# Add breakline, space, semi-colon
echo "-----"
for x in "${list[@]}"; do
    echo "    $x;"
done

# Reset IFS
IFS=$OIFS
