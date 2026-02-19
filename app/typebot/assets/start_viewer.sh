#!/bin/bash

cd install_directory/apps/viewer/ &&
exec mise x bun@1.2 -- bun -- start -p 3001
