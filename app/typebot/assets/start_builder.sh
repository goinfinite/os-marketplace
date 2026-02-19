#!/bin/bash

cd install_directory/apps/builder/ &&
exec mise x bun@1.2 -- bun -- start -p 3000
