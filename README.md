# Component 

### Here is the example hpw to use component

```php
use Henrik\Component\Component;

require "../vendor/autoload.php";

class Simple extends Component{
    private int $x;

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }
}

$simple = new Simple();
$simple->x = 45;  //accessing the private property of `Simple` class by getter and setter
echo $simple->x;
```