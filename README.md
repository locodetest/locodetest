Console output:<br>
\> php bin/console app:updatelocode<br>
[21:28:11]: getting LOCODE update...<br>
[21:28:13]: unpacking LOCODE update...<br>
[21:28:13]: clearing DB...<br>
[21:28:13]: importing CSVs...<br>
[21:28:13]: /Users/paul/Sites/locode/var/work/2020-1 UNLOCODE CodeListPart1.csv...
done!<br>
[21:28:13]: /Users/paul/Sites/locode/var/work/2020-1 UNLOCODE CodeListPart3.csv...
done!<br>
[21:28:14]: /Users/paul/Sites/locode/var/work/2020-1 UNLOCODE CodeListPart2.csv...
done!<br>
Update complete<br>

API calls:<br>
http://127.0.0.1:8123/api/v1.0/locationsByCode/AMM
<pre>
[
    {
        "Country": "GB",
        "Location": "AMM",
        "Name": "Ammanford",
        "NameWoDiacritics": "Ammanford",
        "Subdivision": "CMN",
        "Function": [
            "rail"
        ],
        "Status": "AF",
        "Date": "2020-10-25T00:00:00+00:00",
        "IATA": "",
        "Coordinates": "5148N 00400W",
        "Remarks": ""
    }
]
</pre>

http://127.0.0.1:8123/api/v1.0/locationsByNameWoDiacritics/ame
<pre>
[
    {
        "Country": "PA",
        "Location": "CHM",
        "Name": "Chame",
        "NameWoDiacritics": "Chame",
        "Subdivision": "9",
        "Function": [
            "rail"
        ],
        "Status": "RL",
        "Date": "2020-10-25T00:00:00+00:00",
        "IATA": "",
        "Coordinates": "0835N 07953W",
        "Remarks": ""
    },
    {
        "Country": "GA",
        "Location": "ETA",
        "Name": "Etame FPSO",
        "NameWoDiacritics": "Etame FPSO",
        ...
</pre>

Todo:
<ol>
<li>Fix "Date" column parsing and importing.
<li>Check data types and sizes + add validation of data received from CSV.
<li>Don't replace all the DB but check for updates only (column Change). Soft deletes could be reasonable.
<li>Add pagination to API data listing.
<li>Error handling: exceptions and warnings/logging.
<li>Fulltext search instead of SQL LIKE (MySQL or Elasticsearch based).
<li>Documentation.
<li>Dockerize, as an example take: https://github.com/GaryClarke/nginx-php7.4-mysql8-node-docker-network
<li>Unit tests and e2e tests.
<li>Few minor refactorings.
</ol>

Notes:
<ol>
<li>Importing is implemented basing on Doctrine ORM and is pretty slow.
It will be dramatically faster with raw sql packet insert or LOAD INFILE.
</ol>
