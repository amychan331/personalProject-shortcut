#!/bin/bash
# Program takes in a block of CSS codes for one property (do not include the curvy braces in input),
# and then alphabetizing the propertie list and outputs in a 4-space tab format.

# Get input
echo Enter list of css code, seperated by semi-colon, followed by ENTER and CTR-D:
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
