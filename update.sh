#!/bin/bash

dir="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)/update/$(date +%Y%m%d_%H%M%S)"
if [ -z $1 ]; then
	echo "начальный комит не указан, будет использоваться HEAD^"
	if [ -z $2 ]; then
		echo "последний комит не указан, будет использоваться HEAD"
		files=$(git diff --name-only HEAD^ HEAD)
	else
		files=$(git diff --name-only HEAD^ $2)
	fi
else
	if [ -z $2 ]; then
		echo "последний комит не указан, будет использоваться HEAD"
		files=$(git diff --name-only $1 HEAD)
	else
		files=$(git diff --name-only $1 $2)
	fi
fi
echo '---start---'
for file in $files; do
	directory=$(dirname $file)
	if [ ! -d "$dir/$directory" ]; then
		mkdir -p $dir/$directory
	fi
	echo "$file -> $dir/$file"
	cp $file $dir/$file
done
echo '---finish---'
echo 'обновления сохранены в парке: '$dir

exit 0
