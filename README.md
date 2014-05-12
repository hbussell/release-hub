Release Hub
===========

Automate **your** release process.

# Features

 - Flexible yaml files to describe your process steps.
 - Create manual steps that need approval.
 - Integrate any program into your process steps.
 - Full logging of when and who has run steps.
 - Group your process into stages to manage the full process from stage to testing to production.


# Example configuration

```yaml
check:
 - /var/docroot/release-hub/bin/createBranch.sh {{ checkout }} {{ releaseBranch }} {{ remote }} 
 - /var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry:
   - each branch
 - test feature branches
 - check ticket status
release:
 - /var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }} --dry:
   - each branch
 - deploy release branch to test
 - sync dbs and files from prod to test
regression:
 - testing sign off by business
publish:
 - /var/docroot/release-hub/bin/merge.sh {{ checkout }} {{ branch }} {{ releaseBranch }} {{ remote }}:
   - each branch 
 - send notifications   
```
# Installation

With Ansible

git clone git@github.com:hbussell/release-hub.git
cd release-hub
ansible-playbook setup.yml -i inventory

