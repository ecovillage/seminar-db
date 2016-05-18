#!/bin/bash

# Zip Seminar DB Plugin

cd .. && zip -r seminar_db.zip seminar_db --exclude seminar_db/.git/\* seminar_db/zipit.sh
