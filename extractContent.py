#! /usr/bin/env python

# Title: extractContent.py
# Author: Amy Yuen Ying Chan
# Description: Read input file, which contains a book's content page.
#   Then extract the matched string and list them with number.

import re
import os.path

inputFile = raw_input("Input file name: ")
lineId = raw_input("Enter line identifier[Project #]: ") or "Project #"
delimit = raw_input("Enter word delimiter before topic[: ]: ") or ": "
outputFile = raw_input("Output file name: ")

def check(outputFile):
	if (os.path.isfile(inputFile)):
		while (os.path.exists(outputFile)):
			outputFile = raw_input("File already exist. Enter a new one: ")
		create()
	else:
		print("Please input valid file name.")

def create():
	index = 1;
	outputContent = open(outputFile, 'w')
	with open(inputFile, 'r') as inputContent:
		for line in inputContent:
			# Grab line with identifer
			if lineId in line:
				# Extract only substring after delimiter, and output that with an index number.
				# str() needed because Python does not implicitly convert type during concatenation.
				outputContent.write(str(index) + ": " + line.split(delimit)[1])
				index += 1
	inputContent.close()
	outputContent.close()

while (not outputFile):
	outputFile = raw_input("No output file name entered. Please enter output file name: ")
check(outputFile)
