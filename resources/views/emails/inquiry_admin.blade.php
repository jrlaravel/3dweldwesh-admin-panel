@component('mail::message')
# New Inquiry Received

You have received a new inquiry from the website.

**Details:**
- **Name:** {{ $inquiry->name }}
- **Email:** {{ $inquiry->email }}
- **Phone:** {{ $inquiry->phone }}
- **Location:** {{ $inquiry->location }}
- **Project Type:** {{ $inquiry->project_type }}
- **Fencing Needed:** {{ $inquiry->fencing_needed ? 'Yes' : 'No' }}

**Message:**
{{ $inquiry->message }}

@component('mail::button', ['url' => route('inquiry')])
View All Inquiries
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
