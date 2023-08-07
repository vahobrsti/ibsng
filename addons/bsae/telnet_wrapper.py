#!/usr/bin/python -O
"""
sys.argv[1]: username


"""
import sys
import os

port=sys.argv[1]
os.system("occtl disconnect user %s 2>&1"%username)
