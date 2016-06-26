<?php
/**
 * Cart Items API for third-party shopping cart or paypal shopping cart
 *
 * @package     GoPayPal
 * @copyright   Copyright (c), GoPayPal
 * @author      Sithu K. <cithukyaw@gmail.com>
 * @link        https://github.com/cithukyaw/go-paypal
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE
 */

/**
 * Cart Items API for third-party shopping cart or paypal shopping cart
 */
class GoPayPalCartItem
{
    private $variables;

    /**
     * Constructore
     */
    public function GoPayPalCartItem()
    {
        $this->variables = array(
            # IMPORTANT - the numbers in the place of "x" will be auto generated. No need to include in instants.
            'amount'        => '',  # amount_x          Required    Price of item #x
            'handling'      => '',  # handling_x        Optional    The cost of handling for item #x
            'item_name'     => '',  # item_name_x       Required    Name of item #x in the cart. Must be alphanumeric  limit: 127
            'item_number'   => '',  # item_number_x     Optional    Variable for you to track order or other purchase.
            'on0'           => '',  # on0_x             Optional    First optional field name for item #x 	limit: 64
            'on1'           => '',  # on1_x             Optional    Second optional field name for item #x 	limit: 64
            'os0'           => '',  # os0_x             Optional    First set of optional value(s) for item #x. Requires that on0_x also be set.    limit: 200
            'os1'           => '',  # os1_x             Optional    Second set of optional value(s) for item #x. Requires that on1_x also be set.   limit: 200
            'quantity'      => '',  # quantity_x        Optional    Quantity of the item #x. The value of quantity_x must be a positive integer.
                                    #                               Null, zero, or negative numbers are not allowed.
            'shipping'      => '',  # shipping_x        Optional    The cost of shipping the first piece (quantity of 1) of item #x.
            'shipping2'     => '',  # shipping2_x       Optional    The cost of shipping each additional piece (quantity of 2 or more) of item #x.
            'tax'           => '',  # tax_x             Optional    The tax amount for item #x.
            'weight'        => '',  # weight_x          Optional    The weight of item #x
            'undefined_quantity' => '',  #              Optional    1 – allows buyers to specify the quantity. Optional for Buy Now Button, Not used for other buttons
        );
    }

    /**
     * Set variable
     * @param string $key   The variable name
     * @param mixed  $value The variable value
     */
    public function set($key, $value)
    {
        $this->variables[$key] = $value;
    }

    /**
     * Get variable
     * @param string $key   The variable name
     * @return mixed The variable value
     */
    public function get($key)
    {
        return isset($this->variables[$key]) ? $this->variables[$key] : '';
    }

    /**
     * Get variables
     * @return mixed The variables
     */
    public function getVars()
    {
        return $this->variables;
    }

}
