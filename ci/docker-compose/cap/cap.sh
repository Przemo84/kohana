#!/bin/bash

chmod 600 /ssh-keys -R

# Start ssh agent
eval `ssh-agent -s`

# add ssh key
ssh-add /ssh-keys/id_rsa

ssh -T git@git.etd24.pl

cap $@