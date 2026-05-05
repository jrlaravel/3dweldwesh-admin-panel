@component('mail::message')
# Thank you for contacting us!

Dear {{ $inquiry->name }},

Thank you for reaching out to 3dWeldmesh. We have received your inquiry and our team will get back to you shortly.

**Summary of your inquiry:**
- **Project Type:** {{ $inquiry->project_type }}
- **Location:** {{ $inquiry->location }}

If you have any urgent questions, feel free to reply to this email or call us directly.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
