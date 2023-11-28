composer -v > /dev/null 2>&1
COMPOSER=$?
if [[ $COMPOSER -ne 0 ]]; then
    echo 'Composer is not installed'
    echo 'Go to https://getcomposer.org/download/ and download composer'
else
    composer install
fi