#!/bin/sh
CHECKOUT=$1
SOURCE_BRANCH=$2
DEST_BRANCH=$3
REMOTE=$4
DRY=$5
echo "Run source: $SOURCE_BRANCH"

cd $CHECKOUT
git fetch $REMOTE
EXISTS_ON_REMOTE=`git branch -ar | grep "$REMOTE/$SOURCE_BRANCH"`
echo "Exists on remote:: $EXISTS_ON_REMOTE"

if [ -z != $EXISTS_ON_REMOTE ] 
then
  
  EXISTS_ON_LOCAL=`git branch --list $SOURCE_BRANCH`
  echo "Exists on Local:: $EXISTS_ON_LOCAL"

  if [ -z != $EXISTS_ON_LOCAL ] 
  then
    # does exit on local
    echo "Checking out source branch ... "
    git checkout $SOURCE_BRANCH
  else
    echo "checkout out source branch from remote"
    git checkout -b $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH
  fi

#  echo "pull remote :::: git pull $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH"
#  git pull $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH

  echo "checking out to dest branch : $DEST_BRANCH"
  git checkout $DEST_BRANCH
  echo "merging source : $SOURCE_BRANCH"
  git merge $SOURCE_BRANCH --no-edit --ff-only
  MERGE_STATUS=$?  
  
  if [ "$DRY" = "--dry" ]
  then
    git reset --merge ORIG_HEAD
  fi

  exit $MERGE_STATUS

    

else
  echo "Branch does not exist on remote: $SOURCE_BRANCH"
  exit 1
fi

#/usr/bin/git checkout -b $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH 
#CHECKOUT_STATUS=$?
#echo "checkout status : $CHECKOUT_STATUS"
