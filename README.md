Ramverk1 Projekt: Questionable
==============================

[![Build Status](https://travis-ci.org/SpaceLenore/ramverk1-project.svg?branch=master)](https://travis-ci.org/SpaceLenore/ramverk1-project)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/SpaceLenore/ramverk1-project/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/SpaceLenore/ramverk1-project/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/SpaceLenore/ramverk1-project/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/SpaceLenore/ramverk1-project/?branch=master)

## How to install
* fetch the codebase `git clone https://github.com/SpaceLenore/ramverk1-project`  
* create a database `sqlite3 data/db.sqlite`  
* insert tables into db  
`sqlite3 data/db.sqlite < sql/ddl/user_sqlite.sql`  
`sqlite3 data/db.sqlite < sql/ddl/ask_sqlite.sql`  
`sqlite3 data/db.sqlite < sql/ddl/replies_sqlite.sql`  

## License
See LICENSE.txt for details
