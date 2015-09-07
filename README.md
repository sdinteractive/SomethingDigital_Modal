# SomethingDigital_Modal

SomethingDigital_Modal is a tool to speed up and standardize the implementation of modals.

Install the module, add your markup to a static block (set as a "modal" through the system configuration), and it handles the rest.

The module includes a number of configuration options so that its behavior can easily be tweaked from the backend and it uses a simple markup convention to do its magic. It does not load any additional libraries and leverages the Window.js library that is included with Magento.

SomethingDigital_Modal was specifically crafted to handle email collection modals.

## Markup Convention

SomethingDigital_Modal relies some elements having specific class names for its functionality to work. Here they are...

- `#modal` The outermost element of the static block should be given an ID of `#modal`. This is necessary for functionality that allows the modal to be closed by clicking outside the box.
- `.close-modal` Any elements that will close the modal should be given a class of `.close-modal`.
- `#modal-form` The form should be given the ID of `#modal-form`. This is necessary for AJAX submission.
- `#modal-before` Wrapper for content that should be displayed in modal before form is submitted
- `#modal-after` Wrapper for content to be displayed in modal after form is submitted. SomethingDigital_Modal uses PrototypeJS's `show()` function which requires this element be hidden via `display: none`
- `#modal-loading` Element that will be shown while the form is being submitted. Should initially by hidden via `display: none`
- `#modal-error` If there are any errors when the form is submitted they will show up here. Should initially be hidden via `display: none`

If you would like to use alternate class and ID names simply copy `modal.phtml` to your sites theme and override these through additional parameters on the `SomethingDigital_Modal` constructor. For example, you could give element to close the modal a different class as follows

```html
<script>
    var somethingdigital_modal = new SomethingDigital_Modal({
        skipCookieCheck: <?php echo $this->getConfig('skip_cookie_check'); ?>,
        cookieDuration: <?php echo $this->getConfig('cookie_duration'); ?>,
        modalZIndex: <?php echo $this->getConfig('modal_z_index'); ?>,
        modalContent: "<?php echo $this->getModalContent(); ?>",
        overlayOpacity: <?php echo $this->getConfig('overlay_opacity'); ?>,
        closeOnOutsideClicks: <?php echo $this->getConfig('close_on_outside_clicks'); ?>,
        errorMessage: "<?php echo $this->getConfig('error_message'); ?>",
        showAfterPageViews: <?php echo $this->getConfig('show_after_page_views'); ?>,
        closeAfterSeconds: <?php echo ($s = $this->getConfig('close_after_seconds')) ? $s : 0; ?>,
        isAlreadySubscribed: <?php echo $this->getIsAlreadySubscribed(); ?>,
        skipIfAlreadySubscribed: <?php echo $this->getConfig('skip_if_already_subscribed'); ?>,
        closeModalElementClass: 'alternate-close-modal-class-name',
    });
</script>
```

Refer to `setupOptions()` in skin/frontend/base/default/js/somethingdigital_modal/modal.js for a full list of values that can be overridden.

### Sample markup

```html
<div id="modal" style="width: 300px; border: 5px solid black; background-color: white; margin: 0 auto; z-index: 1200; padding: 20px;">
  <div id="modal-before">
    <h3>Welcome</h3>
    <p>Sign up below for 20% off your first order.</p>
    <p style="color: red; display; none;" id="modal-error"></p>
    <form action="newsletter/subscriber/new/" id="modal-form">
      <label for="email">Email Address:</label><br>
      <input type="email" name="email" class="validate-email" required>
      <img src="/skin/adminhtml/default/default/images/rule-ajax-loader.gif" id="modal-loading" style="display: none;"><input type="submit" name="submit" value="Submit">
    </form>
  </div>
  <div id="modal-after" style="display: none;">
    <h3>Thank you</h3>
    <p>Use coupon code SAVE20 to save 20% now!</p>
  </div>
  <p class="close-modal" style="text-decoration:underline;">Close</p>
</div>
```

## Configuration Options

The configuration for SomethingDigital_Modal lives under System > Configuration > General > Content Management > Modal.

The following options are available

- **Enable** Turn modal on and off
- **Static Block** The static block which contains the modal markup. A dropdown with all static blocks will be available to select from.
- **Show After X Page Views** Allows the modal to be suppressed until the visitor has viewed a certain amount of pages.
- **Modal Z-Index** The z-index for the modal. The overlay z-index will be calculated by subtracting one from this value
- **Close On Outside Click** Determines whether the modal should be closed when the user clicks outside the modal
- **Close After X Seconds** Modal will be automatically closed after this number of seconds once it has been successfully submitted. Set to 0 or leave blank if you'd like the modal to stay open until the user explicity closes it
- **Overlay Opacity** Opacity for overlay that shows up behind the modal
- **Error Message** Message that will be displayed to the user if there is an error submitting the form
- **Cookie Duration** Number of days for lifetime of cookie that will flag the fact that the user saw the modal
- **Skip Cookie Check** Will skip the cookie check and show the modal on each page load.
- **Skip If Already Subscribed** Modal will not be shown if the user has already subscribed (email address exists in Newsletter Subscribers). This should most likely be set to "Yes", unless the modal will serve another purpose than to collect email addresses

## Query String Parameters

- `?forceModal=1` will force the modal to display, even if the user has already been cookied as having `seenModal`. This can be useful with clients so they don't have clear their cookies to look at the modal multiple times. The "Skip Cookie Check" configuration option has the same ultimate effect, but is intended for development purposes where as the query string is more useful during client demos.
- `?suppressModal=1` will prevent the modal from being displayed for the duration of the users session. If there are questions about the ROI / bounce rate impacts of the modal an A/B test can be run with and without this query string to determine the impact of the modal on the site

## Other notes

While the module does require a static block, it's ultimately extremely flexible in terms of modal implementation workflow. For example, a modal could include all it's styles in line (for ultimate CMS flexibility) or could ship with a stylesheet to keep the markup more clean. The static block could even render a template file if the desire was to keep the content of the static block versioned.
