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

### Sample markup

@todo 

## Configuration Options

The configuration for SomethingDigital_Modal lives under System > Configuration > General > Content Management > Modal.

The following options are available

- **Enable** Turn modal on and off
- **Static Block** The static block which contains the modal markup. A dropdown with all static blocks will be available to select from.
- **Modal Z-Index** The z-index for the modal. The overlay z-index will be calculated by subtracting one from this value
- **Close On Outside Click** Determines whether the modal should be closed when the user clicks outside the modal
- **Overlay Opacity** Opacity for overlay that shows up behind the modal
- **Cookie Duration** Number of days for lifetime of cookie that will flag the fact that the user saw the modal
- **Skip Cookie Check** Will skip the cookie check and show the modal on each page load. This is useful during development

## Other notes

While the module does require a static block, it's ultimately extremely flexible in terms of modal implementation workflow. For example, a modal could include all it's styles in line (for ultimate CMS flexibility) or could ship with a stylesheet to keep the markup more clean. The static block could even render a template file if the desire was to keep the content of the static block versioned.
