#!C:\Program Files\WindowsApps\PythonSoftwareFoundation.Python.3.10_3.10.2288.0_x64__qbz5n2kfra8p0\python3.10.exe

import os
import urllib.parse

sent_query = os.environ['QUERY_STRING']
query_list = sent_query.split('=')
query_dict = urllib.parse.parse_qs(os.environ['QUERY_STRING'])

def greeter(name, surname):
    return('Hello' + str(name).capitalize() + ' ' + str(surname).capitalize() + 'How are you?')

input_name = str(query_dict['name'])[2:-2]
input_surname = str(query_dict['surname'])[2:-2]

print("Content-Type: text/html\n")
# print(str(greeter(input_name, input_surname)))
print(str(greeter('mike', 'smith')))