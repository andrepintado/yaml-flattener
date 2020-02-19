# yaml-flattener
Flattens a YAML file into a tab separated value list. The left part is the concatenated path of the yaml key and the right part is the value of the yaml entry.

I created this to help me manage [Symfony translation files](https://symfony.com/doc/current/translation.html#basic-translation). It's probably not bullet-proof. Feel free to improve it to handle more complex use cases.

## Usage:

`php yaml_flattener.php <example.yml> <output.tsv>`

The output file is optional. It will output to CLI if not specified. Make sure the yaml is well formatted.

## Requirements:

- PHP 5+
- YAML PHP extension https://www.php.net/manual/en/book.yaml.php

## Example:


```yaml
# forms.yml

signup:
  first_name:
    label: First name
    placeholder: Insert your first name
  last_name:
    label: Last name
    placeholder: Insert your last name
  email:
    label: E-mail
    placeholder: Insert your email address
  password:
    label: Password
    placeholder: Insert your password
login:
  email:
    label: E-mail
    placeholder: Insert your email address
  password:
    label: Password
    placeholder: Insert your password
empty_message: Just an empty message
```

```tsv
# output

signup.first_name.label	First name
signup.first_name.placeholder	Insert your first name
signup.last_name.label	Last name
signup.last_name.placeholder	Insert your last name
signup.email.label	E-mail
signup.email.placeholder	Insert your email address
signup.password.label	Password
signup.password.placeholder	Insert your password
login.email.label	E-mail
login.email.placeholder	Insert your email address
login.password.label	Password
login.password.placeholder	Insert your password
empty_message	Just an empty message
```
