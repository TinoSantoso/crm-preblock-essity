// Export popup value persistence
let exportEmpValue = null;
let exportPeriodValue = null;

function exportData() {
    // Remove any existing popup to ensure a clean state
    $('#export-popup').remove();

    // Create popup container
    $('body').append('<div id="export-popup"></div>');
    const $popup = $('#export-popup');
    $popup.empty();
    const popupContent = $(
        `<div>
            <div style="margin-bottom:15px;">
                <label for="export-period">Period:</label>
                <div id="export-period"></div>
            </div>
        </div>`
    );
    $popup.append(popupContent);

    // Initialize selectboxes before showing popup
    /* const employeeSelect = $('#export-emp').dxSelectBox({
        dataSource: [
            { id: '210402', name: 'EmployeeID 210402' },
            { id: '230501', name: 'EmployeeID 230501' },
            { id: '191230', name: 'EmployeeID 191230' },
            { id: '191105', name: 'EmployeeID 191105' },
            { id: '241101', name: 'EmployeeID 241101' }
        ],
        displayExpr: 'name',
        valueExpr: 'id',
        placeholder: 'Select Employee',
        searchEnabled: true,
        value: exportEmpValue // set previous value if available
    }).dxSelectBox('instance'); */

    const periodSelect = $('#export-period').dxDateBox({
        displayFormat: "yyyy-MM",
        pickerType: "calendar", 
        placeholder: 'Select Period',
        openOnFieldClick: true,
        calendarOptions: {
            maxZoomLevel: "year",
            minZoomLevel: "year",
            zoomLevel: "year"
        },
        useMaskBehavior: true,
        applyValueMode: "instantly",
        value: exportPeriodValue // set previous value if available
    }).dxDateBox('instance');

    $popup.dxPopup({
        title: 'Export Data',
        width: "40vw",
        height: "auto",
        showCloseButton: true,
        hideOnOutsideClick: true,
        visible: true,
        toolbarItems: [
            {
                widget: 'dxButton',
                toolbar: 'bottom',
                location: 'after',
                options: {
                    text: 'Preview',
                    icon: 'fa fa-search',
                    type: 'default',
                    elementAttr: { id: 'export-preview' }
                }
            }
        ],
        onHiding: function() {
            // Store values before hiding
            exportPeriodValue = periodSelect.option('value');
        },
        onHidden: function() {
            // Remove the popup from DOM after it is fully hidden
            $popup.remove();
        }
    });

    $('#export-preview').on('click', async function() {
        let period = periodSelect.option('value');
        if (!period) {
            DevExpress.ui.notify({ message: 'Please select Period.', width: 400, type: 'warning'}, { position: 'top right', direction: 'down-push' }, 3000);
            return;
        }
        // Parse period to year and month
        let year = null, month = null;
        try {
            const dateObj = new Date(period);
            if (!isNaN(dateObj.getTime())) {
                year = dateObj.getFullYear();
                month = String(dateObj.getMonth() + 1).padStart(2, '0');
            }
        } catch (e) {
            const match = /^\d{4}-(\d{2})/.exec(period);
            if (match) {
                year = match[1];
                month = match[2];
            }
        }
        if (!year || !month) {
            DevExpress.ui.notify({ message: 'Invalid period format.', width: 400, type: 'error'}, { position: 'top right', direction: 'down-push' }, 3000);
            return;
        }
        try {
            year = encodeURIComponent(year);
            month = encodeURIComponent(month);
            const url = `/crm-visits?year=${year}&month=${month}`;
            
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            // Populate empId from data if available
            let empId = '';
            if (Array.isArray(data) && data.length > 0 && data[0].emp_id) {
                empId = data[0].emp_id;
            }

            // Group details by visit_date
            let allDetails = [];
            if (Array.isArray(data)) {
                data.forEach(row => {
                    if (Array.isArray(row.details)) {
                        allDetails = allDetails.concat(row.details);
                    }
                });
            }

            // Group by visit_date
            const grouped = {};
            allDetails.forEach(detail => {
                const visitDate = detail.visit_date || 'No Date';
                if (!grouped[visitDate]) grouped[visitDate] = [];
                grouped[visitDate].push(detail);
            });

            // Build preview table HTML with No column
            let html = `
                <html>
                <head>
                    <title>Preview - Employee: ${empId}, Period: ${year}-${month}</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                    <style>
                        body { padding: 24px; font-family: Arial, sans-serif; }
                        .visit-date-title { font-weight: bold; margin-top: 24px; margin-bottom: 8px; }
                        table { background: #fff; }
                        th, td { vertical-align: middle !important; }
                    </style>
                </head>
                <body>
                    <div style="display: flex; align-items: center; margin-bottom: 16px;">
                        <h3 style="margin: 0; margin-right: 16px;">Preview for Employee: ${empId}, Period: ${year}-${month}</h3>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <button id="download-report" class="btn btn-success" style="display: flex; align-items: center; margin-left: auto;">
                            <i class="fa fa-download" style="margin-right: 6px;"></i> Download
                        </button>
                    </div>
            `;

            if (Object.keys(grouped).length === 0) {
                html += `<div style="color:#888;">No details data found for this selection.</div>`;
            } else {
                // Get sorted visit dates
                const visitDates = Object.keys(grouped).sort();
                // Process two visit dates per row
                for (let i = 0; i < visitDates.length; i += 2) {
                    html += `<div class="row" style="display: flex; flex-wrap: wrap; margin-bottom: 24px;">`;

                    // First table (left)
                    const visitDate1 = visitDates[i];
                    html += `<div class="col" style="flex:1; min-width: 0; max-width: 50%; padding-right: 8px;">`;
                    html += `<div class="visit-date-title">Visit Date: ${visitDate1}</div>`;
                    html += `<table class="table table-bordered table-sm" style="width:100%;margin-bottom:8px;">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th style="width: 350px; min-width: 300px; max-width: 400px;">Institusi</th>
                                <th>Specialty</th>
                                <th>Individu</th>
                            </tr>
                        </thead>
                        <tbody>`;
                    grouped[visitDate1].forEach((detail, idx) => {
                        html += `<tr>
                            <td>${idx + 1}</td>
                            <td style="width: 350px; min-width: 300px; max-width: 400px; word-break: break-word;">${detail.account ?? ''}</td>
                            <td>${detail.class ?? ''}</td>
                            <td>${detail.contact ?? ''}</td>
                        </tr>`;
                    });
                    html += `</tbody></table>`;
                    html += `</div>`;

                    // Second table (right), if exists
                    if (i + 1 < visitDates.length) {
                        const visitDate2 = visitDates[i + 1];
                        html += `<div class="col" style="flex:1; min-width: 0; max-width: 50%; padding-left: 8px;">`;
                        html += `<div class="visit-date-title">Visit Date: ${visitDate2}</div>`;
                        html += `<table class="table table-bordered table-sm" style="width:100%;margin-bottom:8px;">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th style="width: 350px; min-width: 300px; max-width: 400px;">Institusi</th>
                                    <th>Specialty</th>
                                    <th>Individu</th>
                                </tr>
                            </thead>
                            <tbody>`;
                        grouped[visitDate2].forEach((detail, idx) => {
                            html += `<tr>
                                <td>${idx + 1}</td>
                                <td style="width: 350px; min-width: 300px; max-width: 400px; word-break: break-word;">${detail.account ?? ''}</td>
                                <td>${detail.class ?? ''}</td>
                                <td>${detail.contact ?? ''}</td>
                            </tr>`;
                        });
                        html += `</tbody></table>`;
                        html += `</div>`;
                    } else {
                        // If only one table in this row, add an empty column for alignment
                        html += `<div class="col" style="flex:1; min-width: 0; max-width: 50%; padding-left: 8px;"></div>`;
                    }

                    html += `</div>`; // close row
                }
            }
            html += `
                </body>
                <script>
                    document.getElementById('download-report').addEventListener('click', function() {
                        // Use a POST request with CSRF token for better security
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/crm-visits/export-pdf';

                        // Add CSRF token if available
                        const csrfToken = (window.parent || window).document.querySelector('meta[name="csrf-token"]');
                        if (csrfToken) {
                            const inputCsrf = document.createElement('input');
                            inputCsrf.type = 'hidden';
                            inputCsrf.name = '_token';
                            inputCsrf.value = csrfToken.getAttribute('content');
                            form.appendChild(inputCsrf);
                        }

                        // Add parameters as hidden fields
                        const params = {
                            year: "${year}",
                            month: "${month}"
                        };
                        for (const key in params) {
                            if (params.hasOwnProperty(key)) {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = key;
                                input.value = params[key];
                                form.appendChild(input);
                            }
                        }

                        document.body.appendChild(form);
                        form.submit();
                        document.body.removeChild(form);
                    });
                </script>
                </html>
            `;

            // Open in new tab and write the HTML
            const previewWindow = window.open('', '_blank');
            if (previewWindow) {
                previewWindow.document.open();
                previewWindow.document.write(html);
                previewWindow.document.close();
            } else {
                DevExpress.ui.notify({
                    message: 'Popup blocked! Please allow popups for this site to see the preview.',
                    width: 400,
                    type: 'error'
                }, { position: 'top right', direction: 'down-push' }, 4000);
            }

            DevExpress.ui.notify({
                message: `Preview loaded for Period: ${decodeURIComponent(year)}-${decodeURIComponent(month)}`, 
                width: 400, 
                type: 'success'
            }, { position: 'top right', direction: 'down-push' }, 3000);
        } catch (error) {
            DevExpress.ui.notify({ 
                message: 'Error loading preview: ' + error.message, 
                width: 400, 
                type: 'error'
            }, { position: 'top right', direction: 'down-push' }, 4000);
        }
    });
}
