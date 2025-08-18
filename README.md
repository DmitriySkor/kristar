# Repository information

<table>
    <tr>
        <td>Project</td>
        <td>Kristar - Kristar show</td>
    </tr>
    <tr>
        <td>Site name</td>
        <td>Kristar show</td>
    </tr>
    <tr>
        <td>Site url</td>
        <td>kristar.show</td>
    </tr>
    <tr>
        <td>CMS</td>
        <td>WordPress</td>
    </tr>
    <tr>
        <td>Project part</td>
        <td>code, media, db</td>
    </tr>
</table>

## Theme information :
<table>
    <tr>
        <td>Name</td>
        <td>montoya</td>
    </tr>
    <tr>
        <td>Version</td>
        <td>2.1.0</td>
    </tr>
</table>

## Preparing a project for working with ddev :
1. Download the project parts and create the structure:
<table>
    <tr style="text-align: center">
        <td>0</td>
        <td>1</td>
    </tr>
    <tr>
        <td>kristar.show</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>code ( repository )</td>
    </tr>
</table>  

2. Run project in ddev
    1. ddev restart

3. Add wordpress configuration :
   1. Copy .../code/wp-config-<env_name>.php file to .../code/web/wp-config.php file

4. Import DB :
    1. ddev import-db --file=db/kristar.sql - import DB.
    2. ddev ssh - connect to the server via ssh.
    3. wp search-replace kristar.show kristar.show.ddev.site - change domain name in DB.
    4. exit

### ddev commands :
#### DB export :
- For ddev:
  - ddev export-db --database=db --file=db/kristar-loc.sql --gzip=false
- For prod:
  - ddev export-db --database=db --file=db/kristar.sql --gzip=false

#### DB import :
- From ddev:
  - ddev import-db --file=db/kristar-loc.sql

- From prod:
  - ddev import-db --file=db/kristar.sql

#### Changed Domain :
- For ddev:
  - ddev ssh
  - wp search-replace kristar.show kristar.show.ddev.site
- For prod:
  - ddev ssh
  - wp search-replace kristar.show.ddev.site kristar.show

### DB :
- Backup :
  - MySQL :
    - mysqldump -u u675256559_bubbleswp -p u675256559_bubkrist444 > kristar.sql
    - mysqldump -u u675256559_bubbleswp -p u675256559_bubkrist444 | gzip -9 > kristar_$(date +"%Y%m%d_%H%M%S").sql.gz
- Restore :
  - mysql -u u675256559_bubbleswp -p u675256559_bubkrist444 < kristar.sql

## Users
| # | User  | Password              | E-mail             |
|---|-------|-----------------------|--------------------|
| 1 | admin | aM4tCTIFlMHrhRp4i1WbS | rionskey@gmail.com |
| 2 | qa    | -                     | xxx@xxx.com        |
