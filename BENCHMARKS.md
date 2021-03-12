### Latest benchmarks

* Language: PHP
* OS: OSX
* Processor: Intel Core i5
* Processor Speed:	2.9 GHz
* Memory: 8GB

| Test Case             | Array Reduce | For Loop | Foreach By Reference | Foreach By Value | Regex |
|-----------------------| -------------|----------|----------------------|------------------|-------|
| **Long passing string**  | 10414891     | 8201242  | 9594977              | 7511018          | 55902 |
| **Medium passing string** | 7828         | 6415     | 6955                 | 6190             | 337   |
| **Medium failing string** | 10084        | 7614     | 7862                 | 6833             | 329   |
| **Short failing string**  | 493          | 341      | 376                  | 325              | 264   |
| **Multibyte string**      | 2414         | 955      | 1064                 | 910              | 302   |

<span>* Results are in nanoseconds</span>

[Go back](README.md)
