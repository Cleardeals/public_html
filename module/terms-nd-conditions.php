<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='13'";
$dbSitecontent = $dbObj->SelectQuery();
?>
<div class="center-section-in">
  <div class="container">
  <?php $heading = explode(' ',$dbSitecontent[0]['heading'],2);?>
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5"> <?=$heading[0] ?? ""?> <span class="themecolor"><?=$heading[1] ?? ""?></span> </h2>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
       <?=html_entity_decode(stripslashes($dbSitecontent[0]['content']))?>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="terms-content">
    <div>
        <h3><strong>Introduction</strong></h3>
                  <p>This website, www.cleardeals.co.in, including any subdomains thereof, and any other
websites through which its services are made available, our mobile, tablet, and other
smart device applications, and application program interfaces (hereinafter collectively
referred to as "Cleardeals"), is owned, hosted, and operated by Proptech Cleardeals Pvt.
Ltd.(hereinafter referred to as "Cleardeals" or "we"), a company incorporated in India
under the Companies Act, 2013, and having its registered office at [208, Aditya plaza
complex, beside Jodhpur urban health centre, Jodhpur corss road, Satellite,
Ahmedabad.]. These Terms and Conditions, along with our Privacy Policy and any
other applicable guidelines or policies, govern the use of these services and constitute a
legally binding agreement between Cleardeals and the user (the "Agreement").</p> 

 <p>Cleardeals and/or any other website(s) linked to this website provide an online platform
for property transactions, including buying, selling, renting, and other real estate-related
services. Access to and use of Cleardeals' services are subject to your compliance with
these Terms and Conditions.</p>

 <p>Cleardeals reserves the right to amend or modify these Terms and Conditions at any
time, and such modifications shall be effective immediately upon posting of the updated
Terms on www.cleardeals.co.in. You should review the modified Terms periodically to
stay informed of any changes. Your continued access to or use of the Cleardeals website
and services shall be deemed as conclusive proof of your acceptance of these Terms, as
amended from time to time. Cleardeals may also suspend the operation of the website
for technical upgrades, maintenance, content updates, or for any other reason deemed
necessary</p></br>

           <p>
           If you use Cleardeals in a manner inconsistent with these Terms and Conditions,
Cleardeals reserves the right to terminate your access, block future access, and/or seek
any other relief deemed appropriate based on the circumstances of misuse.
Contents
           </p>
       
      </div>
      <div class="more-content">
      <div>
        <h3>Definition</h3>
        <p>The term "User" refers to any individual or legal entity who accesses or subscribes to
the services provided by Cleardeals, whether on a free or paid basis, and is granted
access to the Cleardeals platform either through a registered account or as a guest. Users
include anyone using Cleardeals for activities such as browsing property listings,
making inquiries, or using any of Cleardeals’ related services.</p>
        <p>The term "Subscriber" refers to any User who registers for a Cleardeals account,
providing the necessary details to create a user profile, which may include a username
and password. The Subscriber has access to additional services offered by Cleardeals
based on the subscription plan chosen (if any), and can actively use the platform to post
listings, advertise properties, or avail other premium services.</p>
        <p>The term "Browser/Visitor" refers to any person who accesses and uses the Cleardeals
website or mobile application without the need to create an account. This includes
individuals browsing property listings or using the freely accessible areas of the website.</p>
        <p>The term "Advertiser" refers to a User who posts advertisements, listings, or other
content through the Cleardeals platform. This term applies to both individual property
owners, real estate agents, or any other party who engages with the platform to promote
or advertise properties.</p>
        <p>The term "Services" refers to the online platform and any related services offered by
Cleardeals. These services may include but are not limited to, property listings, NO
brokerage services, property management, consultancy, home loan assistance, and other
tools that allow Users to search, view, buy, sell, rent, or advertise real estate. It also
includes any additional features provided by Cleardeals for property owners, agents, or
buyers, such as property valuation, virtual tours, or access to premium listings.</p>
        <p>The term "Unauthorized User" refers to any person who accesses the Cleardeals
platform or uses its services without having a legal or contractual right to do so, or who
violates the terms and conditions set forth by Cleardeals. Unauthorized users are subject
to the terms and conditions governing the use of the platform and may face legal action
or termination of access.</p>
        <p>The terms "User" and "Customer" shall collectively refer to all individuals or entities
accessing the Cleardeals platform, including Subscribers, Advertisers, Browsers, and
Visitors, and is used interchangeably to refer to anyone interacting with the platform in
any capacity.
</p>
<p>The term "Cleardeals Platform" refers to the entire online platform offered by
Cleardeals, including the website www.cleardeals.co.in, mobile applications, APIs, and
any other services provided through Cleardeals for property listings, search, brokerage,
and associated real estate services.</p>
<p>The term "Service" or "Services" includes the interactive online information services
offered by Cleardeals through its website, mobile applications, and any other platforms.
It refers to the search tools, property listings, advertisements, and other real estaterelated information that users can access, browse, and interact with. This also includes
premium services like enhanced property listings, real estate consultancy, and
advertising space for listings or banners</p>

      </div>
      <div>
        <h3>Submission and Administration of Listings/Advertisements</h3>
        <p>By submitting a property listing or advertisement ("Listing") on the Cleardeals
        platform, you, the User, agree to the following terms and conditions:</p>
        <p>1. Rights and Authorizations
 The User submitting a Listing or Advertisement agrees that they have obtained all
necessary rights, permissions, and authorizations from the property owner or authorized
representative (such as a power-of-attorney holder) to publish, advertise, and promote
the property through Cleardeals. This includes obtaining consent from photographers,
copyright holders, or any third parties whose content (such as images or videos) is used
in the Listing. The User is solely responsible for ensuring that all content and
information submitted to Cleardeals is lawful, accurate, and properly authorized.</p>
        <p>2. Cleardeals' Role
 Cleardeals acts solely as a platform that facilitates property transactions and listings.
It does not assume ownership of any property or advertisements submitted by Users.
Any content uploaded by Users, such as property descriptions, photographs, or
advertisements, remains the property of the respective User, subject to the rights granted
to Cleardeals for displaying and distributing the content on the platform.</p>
        <p>Cleardeals does not conduct independent verification of the authenticity, legality, or
compliance of any property listing with applicable laws. It is the responsibility of the
User to ensure that all submitted Listings and advertisements comply with all relevant
laws, including but not limited to real estate regulations, local laws, and intellectual
property laws</p>
        <p>3. Third-Party Content
 Some Listings may contain third-party video content, images, or other media ("ThirdParty Content") that Cleardeals hosts or displays. Such Third-Party Content is provided
for general informational purposes only and does not constitute a recommendation,
endorsement, or solicitation for any property or transaction. Cleardeals makes no
representations or warranties about the accuracy, completeness, or legality of any ThirdParty Content and shall not be liable for any errors or omissions in the content.
</p>
        <p>4. Compliance with Real Estate Laws
 If the User is submitting a property that falls under the scope of the Real Estate
(Regulation and Development) Act, 2016 (RERA), the User shall ensure that all
necessary approvals, licenses, and permits required by the relevant authorities are
obtained and maintained. The User must comply with all legal requirements, including
those related to the project, land, apartment, or plot being listed. Additionally, Users are
required to disclose all material information about the property, including its legal
status, encumbrances, ownership, and title, in accordance with the relevant real estate
regulations</p>
        <p>5. Accuracy and Disclosure
 The User represents and warrants that all information provided in a Listing is accurate,
complete, and up-to-date. This includes, but is not limited to, the dimensions, ownership
status, encumbrances, and the legal standing of the property. If Cleardeals requests
supporting documentation or evidence to verify the status of the property, the User
agrees to provide such documents within a reasonable time frame. Cleardeals may also
request an affidavit from the User to attest to the authenticity of the information
provided</p>
        <p>6. Right to Modify or Remove Listings
 Cleardeals reserves the right to search for and remove any Listings or advertisements
that, at its sole discretion, are alleged to have been submitted in violation of these terms
and conditions. Additionally, Cleardeals may request Users to provide further evidence
of compliance with these Terms, especially in cases where the authenticity of a Listing
or its compliance with laws is in question.</p>
        <p>7. User Accountability
 Cleardeals may terminate the account of any User who repeatedly or intentionally
violates these terms and conditions, particularly with regard to the submission of false
or misleading property information. Cleardeals also reserves the right to refuse services
to any User found to be in breach of these Terms</p>
        <p>8. Listing and Advertisement Display
 By submitting a Listing or Advertisement on Cleardeals, the User grants Cleardeals
the right to display, search, access, and distribute the Listing, in whole or in part, across
the platform. This includes the right for Cleardeals to modify how the Listing is
presented, searched, and used on the platform, at its sole discretion.</p>
        <p>The User agrees that Cleardeals has the right to modify, resize, or edit Listings,
        including images, to fit the format and requirements of the platform</p>
        <p>9. No Verification of Ownership or Legal Status
 Users who are looking to buy, rent, or lease properties through Cleardeals are solely
responsible for verifying the details of the property, including ownership, title,
encumbrances, and the property's legal status. The "verified" tag associated with a
Listing on Cleardeals simply indicates that the property exists and has been listed on
the platform; it does not constitute a guarantee of ownership, legal status, or any other
aspect of the property.</p>
        <p>10. Cleardeals' Liability
 While Cleardeals strives to provide accurate information, it makes no guarantees or
warranties regarding the completeness, accuracy, or legality of Listings, or the availability of properties. Buyer/Broker/User are advised to conduct their own due
diligence before engaging in any property transaction.</p>
        <p>11. Data Backup
 Cleardeals will make reasonable efforts to back up data and ensure business
continuity. However, it is the responsibility of the User to maintain backup copies of all
information, photographs, and documents submitted to Cleardeals. Cleardeals will not
be liable for any loss or damage to data uploaded by Cleardeals backend team. </p>
        <p>12. Removal of Content
 Cleardeals reserves the right to remove any Listings, advertisements, or content that
violates its terms or is deemed inappropriate, misleading, or harmful to the platform or
its Users. Cleardeals does not assume any obligation to verify or monitor Listings and
assumes no responsibility for the content provided by Users.</p>

      </div>

      <div>
        <h3>Payment Terms</h3>
        <p>Payments for the Services offered by Cleardeals shall be on a 100% advance basis. The
payment for a service once subscribed to by the subscriber is non-refundable, and any
amount paid shall stand appropriated. Refunds, if any, will be at the sole discretion of
Cleardeals. Cleardeals offers no guarantees whatsoever for the accuracy or timeliness
of the refunds reaching the User’s card, bank accounts, or any other payment methods
used, including UPI or links.</p>
        <p>The user acknowledges and agrees that Cleardeals, at its sole discretion and without
prejudice to other rights and remedies it may have under applicable laws, shall be
entitled to set off the amount paid or payable by a subscriber/user against any amount(s)
payable by the user to Cleardeals under any other agreement or commercial relationship
towards other products/services.</p>
        <p>Cleardeals gives no guarantees of server uptime or applications working properly. All
services are provided on a best-effort basis, and liability is limited to a refund of the
amount only. Cleardeals undertakes no liability for free services or any other services
not specifically paid for. Cleardeals reserves the right to amend, alter, or change all or
any disclaimers or terms of agreements at any time without prior notice. All
terms/disclaimers, whether specifically mentioned or not, shall be deemed to be
included if any reference is made to them.</p>
        <p>Relaxation for Genuine Customers
For genuine customers, Cleardeals may offer a relaxation in the payment terms,
allowing part payments. The first 50% of the payment is due at the time of registration,
and the remaining 50% is due after the property has been sold. This relaxation is
provided at the sole discretion of Cleardeals.www.cleardeals.co.in Payment Methods
Cleardeals accepts payments through UPI, credit/debit cards, and payment links. For
completing online transactions involving payments, a user will be directed to a Payment
Gateway. Cleardeals does not store or retain any credit card or UPI details. Since the
transaction is processed through a third-party network, once a payment is completed,
Cleardeals does not have access to the payment information after the transaction is
finalized at the Payment Gateway. This ensures maximum security for all online
transactions.</p>
        <p>www.cleardeals.co.in Liability Disclaimer
Cleardeals shall not be liable for any loss or damage sustained by reason of any
disclosure (inadvertent or otherwise) of any information concerning the user's account
and/or information related to online transactions, including credit card/debit card or UPI
transactions, or their verification process. Cleardeals shall not be held responsible for
any error, omission, or inaccuracy with respect to any information disclosed and used,
whether or not in pursuance of a legal process or otherwise.</p>
      </div>
      <div>
        <h3>Refund Policy for Failed Transactions</h3>
        <p>Though Cleardeals payment reconciliation team works on a 24x7 basis, Cleardeals
offers no guarantees whatsoever for the accuracy or timeliness of the refunds reaching
the subscriber's card, bank account, or any other payment method used. This is due to
the involvement of multiple organizations in the processing of online transactions, as
well as issues related to Internet infrastructure, working days/holidays of financial
institutions, and third-party payment processors.</p>
        <p>Refunds in the event of a failed transaction or an erroneous payment will be processed
by Cleardeals at the earliest possible time, but Cleardeals offers no guarantees for the
exact timing of the refunds. The delay in processing may depend on the payment
method, the third-party payment gateway, and the respective financial institution's
processing time.</p>
        <p>If a transaction involves wrong or objectionable content being posted or any issue
related to the service, Cleardeals will assess the situation at its sole discretion. Refunds
for such cases will be considered, but they are entirely at the discretion of Cleardeals,
and there is no automatic entitlement to a refund</p>
        <p>www.cleardeals.co.in Misuse of Services and Termination
If you utilize Cleardeals services in a manner inconsistent with these terms and
conditions, Cleardeals reserves the right to:
</p>
        <p>
        - Terminate your access to the platform.
        - Block any future access to services provided by Cleardeals.
        - Seek any additional relief or remedies as deemed fit and proper based on the
           circumstances of the misuse.
        </p>
      </div>
      <div>
        <h3>Cleardeals Marketing Campaign Terms</h3>
        <p>1. Lead Delivery and Cost per Lead (CPL)
 Our Relationship Manager (RM) will provide the agreed number of leads and make
100% efforts to meet the targets within the specified timeframe, subject to the conditions
outlined below. Cleardeals (CD) will make reasonable efforts to support and achieve
these objectives.
</p>
        <p>2. Channel/Product Selection
 In the execution of CPL marketing campaigns, CD reserves the right, at its sole
discretion, to determine and deploy the most appropriate channels/products for
advertising and lead generation, without any requirement for prior approval from the
customer.</p>
        <p>3. Campaign Suspension or Termination
 CD reserves the right to stop or terminate any marketing campaign at its sole
discretion, either upon fulfillment of the agreed lead delivery obligations or in the event
of non-receipt of payments in accordance with the terms agreed upon.</p>
        <p>4. Lead Conversion Disclaimer
 CD does not guarantee, participate in, nor is privy to the conversion of the leads into
sales, transactions, or any other potential outcomes resulting from the leads provided.
CD acts as an intermediary in line with the provisions of the Information Technology
Act, 2000. A "lead" refers to a contact detail provided by our backend team who has
consented to being contacted about the advertised properties, projects, or similar
offerings</p>
        <p>5. Non-Refundable Payments
 Any advance payments or amounts received for the agreed marketing campaigns are
non-refundable, irrespective of the outcome or performance of the campaign.</p>
        <p>6. Compliance with Data Privacy Laws
 The customer agrees to fully comply with applicable data privacy laws, including but
not limited to the General Data Protection Regulation (GDPR) or any local regulations
concerning the protection of personal data, for all leads delivered by CD.
</p>
        <p>7. Liability Limitation
 CD will not be liable for any direct, indirect, consequential, or incidental losses or
damages that may arise due to any circumstances, including but not limited to the nonconversion of leads, marketing campaign performance, or third-party interactions.</p>
        <p>8. Duplicate Leads
 In the case where the same lead(s) is generated for the same project within 30 days of
the first unique lead generation date, CD will not charge for the duplicate leads, and
such leads will be considered duplicates. All other leads will be considered unique and
billable.</p>
        <p>9. Data Protection Responsibility
 The customer is responsible for ensuring the protection and lawful processing of
personal data contained in all leads, in compliance with applicable data protection laws.
The customer acknowledges that CD has obtained consent from the leads solely for
sharing the information with the customer to facilitate engagement related to the
advertised projects.</p>
      </div>
      <div>
        <h3>Cleardeals Video Community Guidelines</h3>
        <p>By submitting video content for listings/advertisements on the Cleardeals platform,
        users agree to adhere to the following community guidelines:</p>
        <p>www.cleardeals.co.in 1. Originality & Copyright Compliance
- All video content must be original and free from any copyright infringement. The user
must own the rights to the content or have the necessary permissions for its use.</p>
        <p>www.cleardeals.co.in 2. No Personally Identifiable Information (PII)
- Video content must not contain personally identifiable information (PII) of any user,
agency, or individual. This includes but is not limited to contact details, addresses, or
any sensitive personal data.</p>
        <p>www.cleardeals.co.in 3. Appropriate Content
- Videos must not include content that is obscene, explicit, or otherwise inappropriate.
Cleardeals reserves the right to remove any content deemed unsuitable</p>
        <p>www.cleardeals.co.in 4. Respectful Language
- The content must not contain language or imagery that is discriminatory, offensive, or
detrimental to any community, group, or segment of the population.</p>
      </div>

      <div>
        <h3>Video Content Screening</h3>
        <p>To ensure a safe and respectful environment, videos submitted by users will undergo
multiple stages of screening before going live on the platform. This process may include
both human moderation and technology-driven analysis. In cases where the content
violates the community guidelines, the video will be removed from the listing.</p>
        <p>Additional Video Screening Circumstances
- User Reporting: If a user reports the video through the platform’s toll-free number or
email, it will undergo a review.
- Infringement Claim: If an agent or user submits an infringement claim, the video will
be reviewed, and if the claim is substantiated, the video will be removed.
</p>
        <p>Cleardeals reserves the right to remove any video content at its discretion, even if the
claim or report is found to be unsubstantiated, to maintain the integrity of the platform.
The final decision regarding video screening, removal, and dispute resolution will
always rest with Cleardeals.</p>
       
      </div>

      <div>
        <h3>Video Editing and Removal Rights</h3>
        <p>Third-Party Hosting Services</p>
        <p>Cleardeals may utilize third-party services, such as YouTube, for hosting and streaming
video content. Users must ensure that their videos comply with the terms and conditions
of such third-party services, including but not limited to the following:</p>
        <p>- YouTube Terms of Service: All videos hosted via YouTube must comply with
[YouTube’s Terms of Service](https://www.youtube.com/t/terms) and any applicable
policies outlined in YouTube’s [API Services - Developer
Policies](https://developers.google.com/youtube/terms)</p>
        <p>By submitting video content, the user acknowledges that they are also bound by the
terms and conditions of any third-party hosting services used by Cleardeals.
</p>
        <p>Final Discretion</p>
        <p>Cleardeals reserves the right, at its sole discretion, to refuse, remove, or alter any video
content that it deems to be in violation of its community guidelines or that fails to meet
the standards set by the platform.
To update the Use of Information terms for Cleardeals, reflecting similar practices while
ensuring alignment with the platform's operations, here is a revised version of the terms:
</p>
        <p>By accessing and using the Cleardeals Service, the User agrees to treat all information
obtained from the Service, including property listings, member directories, and any
other information otherwise made available to the User through the platform
("Content"), as proprietary to Cleardeals. The User further agrees to maintain all
Content that is reserved for members as confidential and to protect it as a trade secret
of Cleardeals.</p>
        <p>1. Content Usage and Accuracy
- Cleardeals does not guarantee the accuracy, completeness, or correctness of any
Content and does not endorse or recommend any such Content. The User acknowledges
that they use Content at their own risk. The Content provided is intended solely for
initial informational purposes, from which further evaluation, investigation, or actions
may be initiated.</p>
        <p>2. Restrictions on Reproduction
- Users shall not reproduce, distribute, or use any Content obtained from the Service, or
that is otherwise made available to the User, for or in connection with any other listing
or advertising service, platform, or device. The use of Cleardeals' Content in connection
with any third-party listing service, advertising platform, or commercial application is
strictly prohibited.
</p>
        <p>3. Prohibited Activities
- Users shall not engage in activities such as excessive or abusive searching, automated
scraping, or other actions that misuse the Service, either manually or through automated
means. Any such activity may result in the immediate termination of the User's
membership and access to the platform without prior notice.</p>
      </div>
      <div>
        <h3>Cleardeals Intellectual Property Rights</h3>
        <p>All logos, brands, trademarks, service marks, and other distinctive identifiers ("Marks")
appearing on Cleardeals are either owned or used under license by Cleardeals and/or its
associates. The company has applied for trademark protection, and all rights accruing
from these Marks, whether statutory or otherwise, shall fully vest with Cleardeals or its
associates upon the successful registration of the trademarks.</p>
        <p>The access to Cleardeals does not confer upon the User any license or right to use these
Marks, and therefore, the use of these Marks in any form or manner, whatsoever, is
strictly prohibited without prior written consent. Any unauthorized use of these Marks
will constitute an infringement of Cleardeals' intellectual property and may lead to legal
action under the prevailing laws of India.</p>
        <p>Cleardeals respects the Intellectual Property Rights (IPR) of all parties and adheres to
all applicable laws in India regarding the protection of intellectual property. The
company is committed to protecting the intellectual property rights of its users, clients,
and third parties to the best of its ability. If a User is found using Cleardeals as a platform
to infringe the intellectual property rights of others, Cleardeals reserves the right to
terminate the User’s access to the platform and terminate this Agreement immediately,
without notice.</p>
        <p>By accessing Cleardeals, the User is granted a limited, non-exclusive, non-assignable,
revocable license (the "License") to use the platform and services provided, subject to
the User’s compliance with the terms and conditions of this Agreement. This License
may be revoked at any time if the User violates any terms of this Agreement.</p>
       
      </div>

      <div>
        <h3>Cleardeals Restrictions/Prohibitions
        </h3>
        <p>The following actions will constitute a misuse of Cleardeals and are strictly prohibited:</p>
        <p>1. Improper Use of Services
 - Utilizing the services offered by Cleardeals in any manner that may impair the
interests or functioning of Cleardeals and which is non-compliant with applicable laws
and regulations, including but not limited to the Real Estate (Regulation and
Development) Act (RERA), and any other property-specific laws or regulations</p>
        <p>2. Exploitation of Content
 - Copying, extracting, downloading, sharing, modifying, selling, storing, distributing,
making derivative works from, or otherwise exploiting any content, data, or information
available on Cleardeals (including profiles, personal details, photographs, and/or
graphics) in any manner or for any purpose that is inconsistent with the Terms of Use.</p>
        <p> Users are expressly prohibited from using or exploiting Cleardeals and/or any content
or data provided therein for:
 - Any commercial purposes such as creating alternate databases, extending access to
Cleardeals to third parties without prior written consent from Cleardeals;
 - Undertaking any business activity that directly competes with the business of
Cleardeals;
 - Sharing access with individuals or entities who are not contracted with Cleardeals;
 - Reselling products or services offered by Cleardeals, including listings on third-party
platforms.
</p>
        <p>3. Automated Access
 - Using or attempting to use any automated program, software, or system (including
spiders, robots, crawlers, etc.) to access, navigate, search, copy, monitor, download,
scrape, crawl, or otherwise extract any data or content, including but not limited to
adding or downloading profiles, contact details, or redirecting messages from
Cleardeals.
</p>
        <p>4. Unauthorized Access
 - Gaining or attempting to gain unauthorized access (including through hacking,
password "mining," or any other means) to:
 - Any portion or feature of Cleardeals or any of its services or products that are not
intended for the User;
- Any server, website, program, or computer system of Cleardeals or any other thirdparty or User systems.</p>
        <p>5. Modification of Services
 - Modifying Cleardeals’ services or their appearance using any technology, or
overlaying any additional offerings on top of such services, or simulating the services
or functions of Cleardeals in any manner without prior written consent.</p>
        <p>6. Unauthorized Interfaces
 - Accessing Cleardeals through interfaces other than those expressly provided by
Cleardeals</p>
        <p>7. Security Breaches
 - Attempting to breach or breaching any security or authentication measures set up by
Cleardeals, including probing, scanning, or testing the vulnerability of its system or
network</p>
        <p>8. Scraping or Data Extraction
 - Scraping, downloading (including bulk downloading), replicating, or extracting any
data from Cleardeals to offer any products or services that are similar to or may compete
with Cleardeals’ products or services, including listings on third-party platforms.
</p>
<p>9. Reverse Engineering
 - Reverse engineering, decompiling, disassembling, deciphering, or otherwise
attempting to derive the source code for Cleardeals’ site or app, or any related
technology or any part thereof.</p>
<p>10. Circumventing Protections
 - Circumventing any technological protections employed by Cleardeals or any third
party to protect content or to exclude automated processes (e.g., robots, spiders) from
crawling or scraping content.</p>
<p>11. Bypassing Service Limits
 - Bypassing or attempting to bypass any service limits such as search limits, Captcha
limits, or triggers within Cleardeals.</p>
<p>12. Interference or Disruption
 - Interfering with, disrupting, or attempting to disrupt the use of Cleardeals or any
computer networks connected to Cleardeals, including by using any device, software,
or routine.</p>
<p>13. Misuse of Automated Programs
- Developing, using, or attempting to use any automated program, scripts, robots,
third-party software, or system to access, search, copy, monitor, download, scrape,
crawl, or modify any data or content from Cleardeals without written consent.
</p>
<p>14. Impersonation
 - Impersonating any person or entity, or misrepresenting your affiliation with any
person or entity.</p>
<p>15. Forgery of Headers
 - Forging headers or manipulating identifiers to disguise the origin of any user
information.</p>
        <p>16. Harassment and Stalking
 - Stalking, threatening, or harassing any other User.
</p>
        <p>17. Excessive Load
 - Imposing an unreasonable or disproportionately large load on Cleardeals’
infrastructure.</p>
        <p>18. Framing or Mirroring
 - Engaging in "framing," "mirroring," or simulating the appearance or function of
Cleardeals (or any part thereof) without permission from Cleardeals.</p>
        <p>19. Spamming
 - Spamming Cleardeals or any other Users, including by uploading, posting,
emailing, or transmitting unsolicited bulk e-mail or unsolicited commercial e-mail.</p>
        <p>20. Illegal, Harmful, or Offensive Content
 - Hosting, uploading, posting, transmitting, publishing, or distributing any material
or information that:
 - Violates any applicable laws, statutes, or regulations;
 - Belongs to another person without their consent;
 - Infringes on the rights of Cleardeals or any third party, including copyright,
trademark, or privacy rights;
 - Contains harmful content such as viruses, malware, or code that disrupts or limits
the functionality of Cleardeals or any computer system;
 - Is grossly harmful, harassing, offensive, or discriminatory based on gender, race,
religion, or any other protected characteristic, or promotes illegal activities;
 - Constitutes a criminal offense, gives rise to liability, or otherwise violates
applicable laws.
</p>
        <p>21. Copyright and Trademark Violation
        - Copying and distributing content from Cleardeals on any other server or modifying
information for commercial use without express written consent. Cleardeals reserves all
rights regarding the use of its content and will act to protect its intellectual property.
        </p>
      </div>
      <div>
        <h3>Links to Third-Party Websites</h3>
        <p>Cleardeals may facilitate listings and advertisements on third-party platforms by paying
premium charges and running content (such as property videos) on those platforms.
However, Cleardeals does not control, endorse, or assume any responsibility for the
content, products, or services provided by these third-party websites. The links to thirdparty platforms are provided for your convenience in promoting or advertising
properties and are not intended to imply an endorsement or affiliation with Cleardeals.</p>
        <p>Users should be aware that when interacting with third-party websites through such
links, they will be subject to the terms and conditions, privacy policies, and practices of
those third-party platforms. Cleardeals does not assume any responsibility or liability
for any loss, damage, or inconvenience caused by the use or reliance on such third-party
websites.</p>
        <p>For payment processing, Cleardeals utilizes third-party services such as credit card
processors and direct bank transfers. All payments are made into the company's
designated bank account, and users are advised to follow the applicable payment
instructions provided by Cleardeals. Payments are processed securely through these
channels, and users agree to provide accurate payment details when using the platform's
services</p>
      </div>

 <div>
        <h3>Disclaimer and Warranties</h3>
        <p>Cleardeals is an intermediary as defined under the Information Technology Act, 2000
(IT Act), and provides a platform for property marketing, listing, and related services.
The content on Cleardeals is provided "AS IS" and on an "AS AVAILABLE" basis,
without warranties or representations of any kind, either express or implied. Cleardeals
and third parties providing materials, services, or content to this platform disclaim all
warranties, express or implied, statutory or otherwise, including, but not limited to,
implied warranties of merchantability, fitness for a particular purpose, non-infringement
of third-party rights, completeness or accuracy of the information, and freedom from
computer viruses or other violations of rights concerning services, products, material,
and contents of Cleardeals</p>
        <p>Views expressed by the users are their own. Cleardeals does not endorse such views and
shall not be responsible for them. While every effort is made to ensure that content on
the platform is not misleading, offensive, or inappropriate, Cleardeals does not
guarantee the accuracy, completeness, or correctness of the information on the site. If
any inaccuracy or improper content is found, please report it immediately to the
platform's support team</p>
        <p>It is solely the responsibility of the user to evaluate the accuracy, completeness, and
usefulness of all opinions, advice, services, and other real estate information listed on
the platform. Cleardeals does not warrant that access to the website will be
uninterrupted, error-free, or that defects will be corrected.</p>
        <p>Cleardeals offers no guarantee or warranties regarding the response to listings,
including property ads. Payments made to Cleardeals are solely for the purposes of
displaying the listed properties.
</p>
        <p>Users are strongly advised to independently verify the authenticity of any pre-launch
offers or projects. Cleardeals does not endorse investment in any projects that have not
received official sanction or have not been launched by the builder/promoter. Users
dealing with such projects do so entirely at their own risk.
</p>
        <p>No information on Cleardeals should be construed as an invitation or offer to invest in
Cleardeals or any of its affiliates. Furthermore, nothing on the platform should be taken
as a recommendation to use any product, process, or service that infringes upon any
patent or other intellectual property rights. Cleardeals makes no representation or
warranty, express or implied, that the use of any services or products offered will not
infringe on any patent or other rights.</p>
        <p>Cleardeals is operated from India, and the materials on the platform are primarily
intended for users in India. Cleardeals does not represent or warrant that the materials
are suitable or available for use in any other jurisdiction. If you access Cleardeals from
outside India, you are entirely responsible for ensuring compliance with all local laws,
international conventions, and treaties applicable in your jurisdiction.</p>
        <p>Cleardeals offers products, services, and content that may vary by region due to local
laws, availability, and other regional factors. The services available in one region may
differ from those in another, and Cleardeals does not guarantee that users in one region
can access the same services or products as those in another. Information on Cleardeals
may reference products, programs, or services not available or announced in your
region. Such references do not imply that Cleardeals intends to announce, launch, or
offer these products, programs, or services in your country.
</p>
       
      </div>

      <div>
        <h3>Limitation of Liability
        </h3>
        <p>Cleardeals ("the Company") is an online platform providing hassle-free real estate
services to home buyers and sellers. The following terms define the limitations of
liability associated with the use of Cleardeals' services:</p>
        <p>1. No Warranty on Service:
 The services provided by Cleardeals are offered on an "AS IS" and "AS AVAILABLE"
basis, with no warranties of any kind, either express or implied. This includes, but is not
limited to, warranties of merchantability, fitness for a particular purpose, or noninfringement of third-party rights.</p>
        <p>2. Third-Party Payment Providers:
 Cleardeals utilizes third-party payment gateways such as Razorpay and Cash-Free for
processing payments. However, Cleardeals is not responsible for any issues or delays
caused by these third-party services. In the event that payment via these platforms fails,
Cleardeals provides alternative payment options, including cheqque, QR code, RTGS,
and NEFT, to ensure a hassle-free payment process for users</p>
        <p>3. Accuracy of Listings:
 Cleardeals makes every effort to ensure the accuracy of the property listings published
on its platform. However, it is the responsibility of the home seller to confirm the details
of their property before it goes live. Listings will only be published on other third-party
platforms after receiving explicit confirmation from the home seller. Cleardeals cannot
be held liable for any inaccuracies in the listing details provided by the seller.</p>
        <p>4. Technical Issues and System Downtime:
 Cleardeals does not guarantee that access to the platform will be uninterrupted, errorfree, or secure. The Company will not be liable for any errors, interruptions, defects,
delays in operation or transmission, computer viruses, or technical failures resulting
from the use of its platform. In the case of service disruptions, Cleardeals will make
reasonable efforts to address the issue as quickly as possible but is not responsible for
any resulting damages.</p>
        <p>5. Liability Limitations for Subscription Services:
 Cleardeals' liability concerning the subscription package is limited solely to the access
and usage of the platform for the duration of the subscription period. The Company is
not responsible for any indirect, incidental, punitive, special, or consequential damages,
including loss of profits or business opportunities, that may arise from the use of the
service.</p>
        <p>6. Indemnity:
 Users agree to indemnify and hold harmless Cleardeals, its affiliates, employees, and
agents from any and all claims, damages, liabilities, and expenses, including legal fees,
arising out of or in connection with their use of the platform, including but not limited
to inaccuracies in listing data, payment issues, or violation of terms of service.
</p>
        <p>7. Force Majeure:
 Cleardeals will not be held liable for any delay or failure in performance due to causes
beyond its reasonable control, including but not limited to natural disasters, war, labor
disputes, or any other force majeure event.</p>
        <p>8. Consumer Rights:
 In accordance with the Consumer Protection Act, 2019, the term "consumer" for the
purposes of liability shall be limited to paid customers who are using Cleardeals'
services for individual (non-commercial) purposes. Cleardeals' performance obligation
is limited to providing access to its platform as per the chosen subscription package.
</p>
      </div>

      <div>
        <h3>Termination</h3>
        <p>Cleardeals reserves the right to terminate or restrict your access to the services, either
partially or fully, in its sole discretion and without prior notice, under the following
circumstances:</p>
        <p>1. Non-Payment or Delayed Payment:
 If the client fails to make the agreed part payment or if the payment is not made in
full by the due date, Cleardeals reserves the right to suspend or terminate the services
immediately. This includes cases where the service period has expired without payment
being received</p>
        <p>2. Expired Service Period:
 Cleardeals will terminate the services if the service period ends and the client has not
made the necessary payment for continuation of services. Cleardeals will inform the
client about the upcoming expiration and the need for payment, but failure to make the
payment within the stipulated time frame will lead to service termination.</p>
        <p>3. Notice of Termination:
 In the event of non-payment or other breaches, Cleardeals will notify the client via
email or send a legal notice to the client’s address. The notice will inform the client of
their payment obligations and that failure to pay may result in further legal action.</p>
        <p>4. Mutual Agreement on Service Continuation:
 Cleardeals may, at its discretion, choose to continue providing services if the client
faces genuine issues preventing timely payment. However, in most cases, services will
not continue beyond the agreed-upon terms if payment is not made within the specified
period.
</p>
        <p>5. Breach of Terms:
 Cleardeals may terminate the services if the client violates any of the terms and
conditions of the agreement or engages in conduct that is inconsistent with the ethical
or operational standards of Cleardeals.</p>
        <p>Termination of services due to non-payment or breach of terms may result in the
forfeiture of any fees paid, and the client may be liable for any outstanding balances or
fees for the duration of the service period. </p>
        <p>Cleardeals reserves the right to take legal action if necessary to recover any unpaid dues.</p>
      </div>

      <div>
        <h3>Indemnification</h3>
        <p>Cleardeals, as a property service platform, operates with the understanding that all
information provided by users is self-reported. Our team collects accurate property
details directly from clients during calls or face-to-face interactions. As such, the
responsibility for the accuracy and legality of the information lies with the user.
Cleardeals ensures that all content and details provided by users are handled in good
faith but does not assume responsibility for any errors or omissions in the information
submitted by users.</p>
        <p>By using our services, you agree to indemnify and hold harmless Cleardeals and its
affiliates, officers, directors, employees, and agents from any claims, actions, or legal
proceedings arising from the use of the platform, including but not limited to those
related to the information provided by users. This includes, without limitation, any
disputes over property details, payment issues, or legal claims resulting from
transactions between buyers and sellers.</p>
        <p>Cleardeals does not guarantee the sale of any property listed on the platform. Our
guarantee is limited to providing the services outlined in the subscription package,
including property listing, marketing, and promotional efforts. Any failure to complete
a sale or transaction between a buyer and seller is solely the responsibility of the parties
involved, and Cleardeals is not liable for any such issues.
</p>
        <p>In the event that a client fails to make payment as per the agreed terms, Cleardeals
reserves the right to take appropriate legal action, which may include sending formal
notices and pursuing legal claims for recovery. Cleardeals does not engage in the
transactions between buyers and sellers but ensures transparency by encouraging
mutual agreement and understanding between both parties.</p>
      </div>
      <div>
        <h3>Privacy Policy</h3>
        <p>At Cleardeals, we prioritize your privacy and are committed to safeguarding your
personal data. This Privacy Policy explains how we collect, use, and protect your
personal information when you use our services.</p>
        <p>1. Information Collection
We collect personal information directly from you through meetings (either at your
home or office) where our executives gather relevant details about your property,
including your name, phone number, email address, property specifics, and location.
This data is essential for providing you with tailored property listing services.</p>
        <p>2. Data Usage
We utilize your information to provide property listing services. Your personal details
such as phone numbers and email addresses are never shared with third-party platforms.
We only share your property information on premium listing portals to maximize
visibility, but your personal contact details remain confidential.</p>
        <p>3. Data Sharing with Third Parties
Cleardeals does not share your personal contact information with third parties except
for the necessary property listing details. When your property is listed on other portals,
only the property data is shared, not your personal phone number or email. We ensure
your privacy by safeguarding this information.
</p>
        <p>4. User Control Over Data
You have visibility into how your property listing is performing. Our backend team
regularly updates you on the status of your property listing, including feedback from
potential buyers, through WhatsApp messages and phone calls. You can track the views
and interactions on your listing, but you cannot independently delete or modify data;
any changes will be managed by Cleardeals.</p>
        <p>5. Data Security
We take robust security measures to protect your personal information. Your data is
stored securely within our CRM platform, and we ensure that sensitive personal details
such as your phone number and address are protected. We also have procedures in place
to prevent unauthorized access to your data.
</p>
        <p>6. Data Retention
Cleardeals retains your data for the duration of your subscription to our services. We
maintain records of payments and other transaction-related information, which are
securely stored for reference. These records are only accessible by authorized personnel,
and we ensure that no unauthorized access occurs.</p>
        <p>7. Regular Updates
Our backend team regularly communicates with clients to update them on the progress
of their property listings, including the positive feedback received from potential
buyers. These updates are sent through WhatsApp messages and calls to keep you
informed about your listing’s performance.</p>
        <p>8. Payment Records
We maintain comprehensive records of all payments made for the services. These
payment records are securely stored and only accessible by authorized personnel within
Cleardeals. </p>
        <p>9. Legal Requests
In the event that Cleardeals is required to disclose personal information due to legal
obligations, we will comply with such requests in accordance with applicable laws.
However, we will not share your personal information with third parties unless legally
required.</p>
      </div>
      <div>
        <h3>Terms of Use for Users</h3>
        <p>By using Cleardeals' services, you agree to the following terms and conditions:</p>
        <p>1. Use of Cleardeals Services
By engaging Cleardeals for property listing services, you consent to providing accurate
and complete information regarding your property. Cleardeals will use this information
to list your property on relevant platforms and ensure that your listing reaches potential
buyers. We do not share your personal contact details with third-party platforms.</p>
        <p>2. Data Sharing and Third Parties
Cleardeals may share your property listing information with third-party platforms for
listing purposes, but personal data such as your phone number or email address will
remain private. We take steps to ensure that your personal information is not disclosed
to unauthorized parties.</p>
        <p>3. Updates and Reports
Cleardeals' backend team will provide you with regular updates regarding your property
listing’s performance. These updates include feedback, views, and inquiries generated
from your property listing. These updates will be sent via WhatsApp and phone calls,
ensuring you stay informed at all times.</p>
        <p>4. Legal Action for Non-Payment
If you fail to make the required payments for the services provided, Cleardeals reserves
the right to terminate services after the agreed period has ended. If payments are not
received within the stipulated time, Cleardeals may send a legal notice requesting
payment. If the issue persists, legal action may be taken.</p>
        <p>5. Termination of Services
Cleardeals reserves the right to terminate services if payment is not made on time or if
you fail to adhere to the agreed terms. Should the service period expire without full
payment, services may be suspended until the payment is settled.</p>
        <p>6. Limitation of Liability
Cleardeals will not be held responsible for any damages, losses, or issues arising from
the use or inability to use the platform, including errors, delays, or issues related to
third-party property listing platforms. Our liability is limited to the services provided
under the selected package.</p>
        <p>7. Changes to Terms
Cleardeals reserves the right to modify or update these terms and conditions. Any
changes will be communicated to you, and it is your responsibility to review the updated
terms periodically. By continuing to use Cleardeals' services, you accept the updated
terms.
Thank you for providing the information for the arbitration and legal terms. To adapt
this content accurately for Cleardeals, I'll ask a few clarifying questions and incorporate
the relevant details for your platform.</p>
      </div>

      <div>
        <h3>Draft for Cleardeals Terms (Based on the information you’ve provided so
        far): (This will require legal information so need to review) </h3>
        <p>Arbitration <br>
In the event of a dispute arising between a user and Cleardeals related to the use of the
platform, including but not limited to the validity, interpretation, implementation, or
alleged breach of any provision of these Terms and Conditions, such dispute shall be
resolved through arbitration. The dispute shall be referred to a sole arbitrator who will
be an independent and neutral third party. The decision of the arbitrator shall be final
and binding on both parties. The place of arbitration shall be [City, Country]. The
arbitration proceedings shall be governed by the Arbitration and Conciliation Act, 1996
(or any updated version), and any other applicable laws.
</p>
        <p>Severability of Provisions<br>
This Agreement governs your use of Cleardeals services. If any provision of these terms
and conditions is found to be invalid or unenforceable under applicable law or a court
order, such provision shall be severed, and the remaining provisions will continue to be
in full force and effect.</p>
        <p>Waiver <br>
The failure of Cleardeals to exercise or enforce any right or provision of these terms
and conditions does not constitute a waiver of such right or provision. Any waiver of
rights by Cleardeals must be provided in writing.
</p>
        <p>Governing Law <br>
By accessing or using Cleardeals, you agree that Indian law will govern all matters
relating to the use of this platform and these terms and conditions. All disputes shall be
governed by the applicable laws of India.</p>
        <p>Jurisdiction <br>
The courts located in [City, India] shall have exclusive jurisdiction over all matters
arising from or in connection with these terms and conditions and your use of the
Cleardeals platform. No other court, outside this jurisdiction, shall have authority over
these disputes.</p>
        <p>Monitoring and Law Enforcement Cooperation <br>
Cleardeals does not routinely monitor your postings or interactions on the platform, but
reserves the right to do so if deemed necessary. In the event of illegal activity, Cleardeals
may report such activity to law enforcement authorities and will cooperate fully with
any investigation involving alleged unlawful conduct</p>
        <p>Grievance Redressal
In case of any complaints or grievances related to Cleardeals services, you can submit
them via our grievance portal at:
[Insert Cleardeals Grievance Portal URL or Contact Information]
Alternatively, you can send complaints to our legal team at [Insert Legal Contact Email].</p>
        <p>Amendment <br>
Cleardeals reserves the right to modify or amend these terms and conditions at any time.
Any changes will be communicated to users, and the revised terms will be effective
from the date they are published on the platform. It is your responsibility to review these
terms periodically to stay updated on any changes.</p>
        <p>Effective Date <br>
These Terms and Conditions are effective from [Insert Date]</p>
        <p></p>
      </div>
        </div>
        <button class="read-more-btn">Read More</button>
      </div>
  </div>
  <div class="clearfix"></div>
</div>

<style>
  .more-content {
    display: none; /* Hide the extra content initially */
}

.read-more-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
}

.read-more-btn:hover {
    background-color: #0056b3;
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
    $(".read-more-btn").click(function (event) {
        event.preventDefault(); // Prevents any unintended default behavior

        let moreContent = $(this).prev(".more-content");

        if (moreContent.is(":visible")) {
            moreContent.slideUp(); // Hide content with animation
            $(this).text("Read More");
        } else {
            moreContent.slideDown(); // Show content with animation
            $(this).text("Read Less");
        }
    });
});

</script>

<script src="<?=HTACCESS_URL?>assets/js/page.js"></script>
<?php include(INCLUDE_DIR.'footer.php'); ?>