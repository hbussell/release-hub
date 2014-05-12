#!/bin/sh
CHECKOUT=$1
SOURCE_BRANCH=$2
DEST_BRANCH=$3
REMOTE=$4
DRY=$5
echo "Run source: $SOURCE_BRANCH"
echo "using checkout :: $CHECKOUT"
echo "using destination branch: $DEST_BRANCH"
echo "using Remote: $REMOTE"
echo "Dry run : $DRY"

cd $CHECKOUT
git fetch $REMOTE
echo "check if branch exists using:  git branch -ar | grep $SOURCE_BRANCH "
BRANCH_EXISTS=$(git branch -ar | grep "$SOURCE_BRANCH")
echo "Branch seach result:: $BRANCH_EXISTS"

if [ -z != $BRANCH_EXISTS ] 
then
  
  EXISTS_ON_LOCAL=$(git branch --list $SOURCE_BRANCH)
  echo "Exists on Local:: $EXISTS_ON_LOCAL"

  if [ -z != $EXISTS_ON_LOCAL ] 
  then
    # does exit on local
    echo "Checking out source branch ... "
    git checkout $SOURCE_BRANCH
  else
    echo "checkout out source branch from remote"
    echo " :: git checkout -b $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH"

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
  echo "Branch does not exist $SOURCE_BRANCH"
  exit 1
fi

#/usr/bin/git checkout -b $SOURCE_BRANCH $REMOTE/$SOURCE_BRANCH 
#CHECKOUT_STATUS=$?
#echo "checkout status : $CHECKOUT_STATUS"
