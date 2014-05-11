#!/bin/sh
CHECKOUT=$1
BRANCH=$2
REMOTE=$3

cd $CHECKOUT
git fetch $REMOTE
EXISTS_ON_REMOTE=`git branch -ar | grep "$REMOTE/$BRANCH"`
echo "Exists on remote:: $EXISTS_ON_REMOTE"

if [ -z != $EXISTS_ON_REMOTE ] 
then
  
  EXISTS_ON_LOCAL=`git branch --list $BRANCH`
  echo "Exists on Local:: $EXISTS_ON_LOCAL"

  if [ -z != $EXISTS_ON_LOCAL ] 
  then
    # does exit on local
    echo "Checking out source branch ... "
    git checkout $BRANCH
  else
    echo "checkout out source branch from remote"
    git checkout -b $BRANCH $REMOTE/$BRANCH
  fi


else
  echo "Branch does not exist on remote: $BRANCH"


  EXISTS_ON_LOCAL=`git branch --list $BRANCH`
  echo "Exists on Local:: $EXISTS_ON_LOCAL"

  if [ -z "$EXISTS_ON_LOCAL" ] 
  then

    git checkout -b $BRANCH
  else
    # does exit on local
    git checkout $BRANCH

  fi


fi

#/usr/bin/git checkout -b $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH 
#CHECKOUT_STATUS=$?
#echo "checkout status : $CHECKOUT_STATUS"
