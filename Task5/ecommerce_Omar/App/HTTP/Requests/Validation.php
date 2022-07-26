<?php

namespace App\HTTP\Requests;

class Validation
{
    private $value;
    private $valueName;
    private array $errors = [];

    public function required(): self
    {
        if (empty($this->value)) {
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} is Required";
        }
        return $this;
    }
    public function max(int $myMax): self
    {
        if (strlen($this->value) > $myMax) {
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} Must be less than {$myMax} Characters";
        }
        return $this;
    }
    public function min(int $myMin): self
    {
        if (strlen($this->value) < $myMin) {
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} Must be greater than {$myMin} Characters";
        }
        return $this;
    }

    public function compare($comparedValue): self
    {
        if ($this->value != $comparedValue) {
            $this->errors[$this->valueName][__FUNCTION__] = "{$comparedValue} Does not match {$this->valueName} ";
        }
        return $this;
    }

    public function regex(string $pattern, $message = null): self
    {
        if (!preg_match($pattern, $this->value)) {
            $this->errors[$this->valueName][__FUNCTION__] = $message ?? " Invalid {$this->valueName} format";
        }
        return $this;
    }

    public function in(array $myValues)
    {
        if (!in_array($this->value, $myValues)) {
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} Must be " . implode($myValues);
        }
        return $this;
    }

    public function string()
    {
        if (!is_string($this->value)) {
            $this->errors[$this->valueName][__FUNCTION__] = "{$this->valueName} Must be string";
        }
        return $this;
    }

    public function unique()
    {
    }

    public function exists()
    {
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set the value of valueName
     *
     * @return  self
     */
    public function setValueName($valueName)
    {
        $this->valueName = $valueName;

        return $this;
    }

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    //plain text error msg
    public function getError(string $error): ?string
    {
        if (isset($this->errors[$error])) {
            foreach ($this->errors[$error] as $error) {
                return $error;
            }
        }
        return null;
    }

    //html styled error msg
    public function getMessage(string $error): string
    {
        return  "<p class='text-danger font-weight-bold'>" . $this->getError($error) . "</p>";
    }
}
