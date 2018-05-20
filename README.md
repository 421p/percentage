# Percentage

### What is it?

A Percentage is a simple tool that finds a GROSS value for given NET and fee.

### Installation

#### Recommended way

Just use docker:

```bash
 docker run 421p/percentage calculate 2 1000
```

### Unpleasant way
```bash
git clone https://github.com/421p/percentage.git
cd percentage
./index.php calculate 2 1000
```

### Usage

Percentage currently supports 2 operations: calculate and find-perfect.

```sh
calculate [options] [--] <fee> <NET>

Options:
  -c, --clean           Show result as a string.

find-perfect [options] [--] <fee> <NET>

Options:
  -l, --limit[=LIMIT]   Limit of calculated values. [default: 10]
```

#### Examples:

```sh
$ docker run 421p/percentage calculate 2 1000

+----------+----------+---------+
|    Calculation for tax: 2%    |
+----------+----------+---------+
|   NET    |  GROSS   |   FEE   |
+----------+----------+---------+
|   1000   | 1020.41  |  20.41  |
+----------+----------+---------+
```

```sh
$ docker run 421p/percentage calculate --clean 2 1000
1020.41
```

```sh
$ docker run 421p/percentage find-perfect 3 1500  
                                                
+----------+----------+---------+
|    Calculation for tax: 3%    |
+----------+----------+---------+
|   NET    |  GROSS   |   FEE   |
+----------+----------+---------+
|   1552   |   1600   |   48    |
|   1649   |   1700   |   51    |
|   1746   |   1800   |   54    |
|   1843   |   1900   |   57    |
|   1940   |   2000   |   60    |
|   2037   |   2100   |   63    |
|   2134   |   2200   |   66    |
|   2231   |   2300   |   69    |
|   2328   |   2400   |   72    |
|   2425   |   2500   |   75    |
+----------+----------+---------+
```

```sh
$ docker run 421p/percentage find-perfect -l4 3 1500

+----------+----------+---------+
|    Calculation for tax: 3%    |
+----------+----------+---------+
|   NET    |  GROSS   |   FEE   |
+----------+----------+---------+
|   1552   |   1600   |   48    |
|   1649   |   1700   |   51    |
|   1746   |   1800   |   54    |
|   1843   |   1900   |   57    |
+----------+----------+---------+
```

