<?php
/**
 * This class can generate HTML for Paypal buttons and forms.
 * It can set a list of parameters for the payments and generates HTML
 * to embed in pages several types of buttons and forms to redirect the user
 * to perform the specified payments in the PayPal site.
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
 * PayPal submit URL
 */
define('PAYPAL_SANDBOX_SUBMIT_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
define('PAYPAL_SUBMIT_URL', 'https://www.paypal.com/cgi-bin/webscr');

/**
 * Pre-defined constants for all API types
 */
define('BUY_NOW', 'BUY_NOW');                   # Buy Now button implementation
define('ADD_TO_CART', 'ADD_TO_CART');           # Add To Cart button implementation
define('PAYPAL_CART', 'PAYPAL_CART');           # Indivitual items with PayPal shopping cart implementation
define('THIRD_PARTY_CART', 'THIRD_PARTY_CART'); # Third-party shopping cart implementation with multiple items
define('DONATE', 'DONATE');                     # Donate button implementation
define('GIFT_CERTIFICATE', 'GIFT_CERTIFICATE'); # Buy Gift Certivicate button implementation
define('SUBSCRIBE', 'SUBSCRIBE');               # Subscribe button implementation

class GoPayPal
{
    ######################
    # PRIVATE ATTRIBUTES #
    ######################
    private $name;          # form name / form id
    private $variables;     # name-value pairs for PayPal API
    private $html;          # final form html
    private $button;        # PayPal ready-made button or custom button
    private $cartItems;     # cart items for shopping cart API
    private $type;          # various types of PayPal API
    #####################
    # PUBLIC ATTRIBUTES #
    #####################
    public  $openInNewWindow;    # true of false; either open PayPal or not
    public  $sandbox;            # true or false; either 'paypal', the real PayPal.com website or 'sandbox', www.sandbox.paypal.com test site

    /**
     * Constructor
     * @param string $type See above "Pre-defined constants for all API types"
     * @param string $name The form name
     */
    public function GoPayPal($type = BUY_NOW, $name='frmPaypal')
    {
        $this->variables = array();
        $this->sandbox = false;
        $this->openInNewWindow = false;
        $this->setType($type);
    }

    /**
     * Prepare variables for PayPal API form hidden fields
     * @param string $key   The variable name ( hidden field name )
     * @param mixed  $value The value for the variable
     */
    public function set($key, $value)
    {
        $this->variables[$key] = $value;
    }

    /**
     * Return value of the specified variable name
     * @param string $key The variable name ( hidden field name )
     * @return mixed The variable value
     */
    public function get($key)
    {
        return $this->variables[$key];
    }

    /**
     * Define PayPal API type
     * @param string $type See the constants above "Pre-defined constants for all API types"
     */
    public function setType($type)
    {
        $this->type = $type;
        switch($type){
            case BUY_NOW:
                $this->set('cmd', '_xclick');
                $this->button = $this->getButton(BUY_NOW); # The button that the person clicked was a Buy Now button.
                break;

            case DONATE:
                $this->set('cmd', '_donations');
                $this->button = $this->getButton(DONATE); # The button that the person clicked was a Donate button.
                break;
            case SUBSCRIBE:
                $this->set('cmd', '_xclick-subscriptions');
                $this->button = $this->getButton(SUBSCRIBE); # The button that the person clicked was a Buy Gift Certificate button.
                break;

            case GIFT_CERTIFICATE:
                $this->set('cmd', '_oe-gift-certificate');
                $this->button = $this->getButton(GIFT_CERTIFICATE); # The button that the person clicked was a Buy Gift Certificate button.
                break;

            case ADD_TO_CART:
                $this->set('cmd', '_cart'); # For shopping cart purchases;
                $this->set('add', 1);       # Add an item to the PayPal Shoppint Cart
                $this->set('display', 1);   # Display the contents of the PayPal Shopping Cart
                $this->button = $this->getButton(ADD_TO_CART);
                break;

            case PAYPAL_CART:
                $this->set('cmd', '_cart'); # For shopping cart purchases;
                $this->set('add', 1);       # Add an item to the PayPal Shoppint Cart
                $this->set('display', 1);   # Display the contents of the PayPal Shopping Cart
                $this->button = $this->getButton(ADD_TO_CART);
                break;

            case THIRD_PARTY_CART:
                $this->set('cmd', '_cart');     # For shopping cart purchases;
                $this->set('upload', 1);        # Upload the contents of a third party shopping cart or a custom shopping cart.
                $this->button = $this->getButton(BUY_NOW);
                break;
        }
    }

    /**
     * Get PayPal supported button HTML
     * @param  string $type (optional) See above "Pre-defined constants for all API types"
     * @return string The button HTML
     */
    public function getButton($type='')
    {
        if ($this->button) {
            return $this->button;
        }

        if (in_array($type, array(BUY_NOW, THIRD_PARTY_CART))) {
            $button = '<input type="image" height="21" style="width:86;border:0px;"';
            $button .= 'src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" ';
            $button .= 'alt="PayPal - The safer, easier way to pay online!">';
        } elseif ($type == DONATE) {
            $button = '<input type="image" height="47" style="width:122;border:0px;"';
            $button .= 'src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit"';
            $button .= 'alt="PayPal - The safer, easier way to pay online!">';
        } elseif($type == SUBSCRIBE) {
            $button = '<input type="image" height="47" style="width:122;border:0px;"';
            $button .= 'src="https://www.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit"';
            $button .= 'alt="PayPal - The safer, easier way to pay online!">';
        } elseif($type == GIFT_CERTIFICATE) {
            $button = '<input type="image" height="47" style="width:179;border:0px;"';
            $button .= 'src="https://www.paypal.com/en_US/i/btn/btn_giftCC_LG.gif" border="0" name="submit"';
            $button .= 'alt="PayPal - The safer, easier way to pay online!">';
        } elseif(in_array($type, array(ADD_TO_CART, PAYPAL_CART))) {
            $button = '<input type="image" height="26" style="width:120;border:0px;"';
            $button .= 'src="https://www.paypal.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit"';
            $button .= 'alt="PayPal - The safer, easier way to pay online!">';
        }

        return $button;
    }

    /**
     * Set custom button html without using PayPal button. This will override default PayPal button
     * @param string $html HTML string
     */
    public function setButton($html)
    {
        $this->button = $html;
    }

    /**
     * Add GoPayPalCartItem object to GoPayPal object for shopping cart items
     * @param object $item GoPayPalCartItem object
     */
    public function addItem($item)
    {
        $this->cartItems[] = $item;
    }

    /**
     * Access Private
     * Return HTML regarding with PayPal API cart item
     */
    private function getCartItemsHtml()
    {
        $html = '';
        if (sizeof($this->cartItems) != 0) {
            if (sizeof($this->cartItems) == 1 && in_array($this->type, array(BUY_NOW, ADD_TO_CART, PAYPAL_CART))) {
                # For individual Item Shopping Cart
                $oneItem = $this->cartItems[0];
                $vars = $oneItem->getVars();
                foreach ($vars as $key => $value) {
                    if( $vars[$key] !== ""){
                        $id = 'pp-'.str_replace('_', '-', $key);
                        $html .= '<input type="hidden" id="'.$id.'" name="'.$key.'" value="'.$value.'" />';
                    }
                }
            } else {
                # For multiple cart items
                $x = 1;
                foreach ($this->cartItems as $oneItem) {
                    $vars = $oneItem->getVars();
                    foreach ($vars as $key => $value) {
                        if ($vars[$key] !== "") {
                            $id = 'pp-'.str_replace('_', '-', $key).'-'.$x;
                            $html .= '<input type="hidden" id="'.$id.'" name="'.$key.'_'.$x.'" value="'.$value.'" />';
                        }
                    }
                    $x++;
                }
            }
        }
        return $html;
    }

    /**
     * Get HTML form without button and the closing </form> tag
     * @return string The entire form HTML for PayPal with form closing tag </form>
     */
    public function getHtml()
    {
        # Check for PayPal ID or an email address associated with PayPal account
        if (!$this->get('business')) {
            echo 'Need to set PayPal ID to the variable "business".<br>';
        }

        # Prepare for form opening
        $url = $this->sandbox == true ? PAYPAL_SANDBOX_SUBMIT_URL : PAYPAL_SUBMIT_URL;

        $this->html .= "<form name=\"{$this->name}\" action=\"{$url}\" method=\"post\"";
        if ($this->openInNewWindow) {
            $this->html .= " target=\"_blank\"";
        }
        $this->html .= ">\n";

        foreach ($this->variables as $key => $value) {
            if ($value !== "") {
                $id = 'pp-'.str_replace('_', '-', $key);
                $this->html .= "<input type=\"hidden\" id=\"$id\" name=\"{$key}\" value=\"{$value}\" />\n";
            }
        }

        $this->html .= $this->getCartItemsHtml();

        return $this->html;
    }

    /**
     * Get HTML form
     * @return string The entire form HTML for PayPal with form closing tag </form>
     */
    public function html()
    {
        $html = $this->getHtml();
        $html .= $this->button;
        $html .= "\n</form>";

        return $html;
    }
}
