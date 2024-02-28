import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:intl/intl.dart';
import 'package:itr/views/widgets/primary_button.dart';

class PersonalInfoTab extends HookWidget {
  const PersonalInfoTab({Key? key, this.onComplete}) : super(key: key);

  final Function()? onComplete;

  @override
  Widget build(BuildContext context) {
    final formKey = GlobalKey<FormState>();
    final firstName = useTextEditingController();
    final lastName = useTextEditingController();
    final ValueNotifier<String?> gender = useState(null);
    final dob = useTextEditingController();
    final address = useTextEditingController();
    final postCode = useTextEditingController();
    final city = useTextEditingController();
    final email = useTextEditingController();

    return Form(
      key: formKey,
      child: ListView(
        children: [
          Text(
            AppLocalizations.of(context)!.add_permanent_details,
            style: Theme.of(context).textTheme.headline6,
          ),
          const SizedBox(height: 16),
          Text(
            AppLocalizations.of(context)!.first_name,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextField(
            controller: firstName,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.last_name,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextField(
            controller: lastName,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.gender,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              ChoiceChip(
                selected: gender.value == 'male' ? true : false,
                label: Text(AppLocalizations.of(context)!.male),
                padding: const EdgeInsets.symmetric(
                  horizontal: 50,
                  vertical: 16,
                ),
                pressElevation: 0,
                selectedColor: Theme.of(context).colorScheme.primary,
                backgroundColor: Theme.of(context).colorScheme.secondary,
                labelStyle: Theme.of(context).textTheme.titleMedium?.copyWith(
                      color: gender.value == 'male' ? Colors.white : null,
                    ),
                shape: const RoundedRectangleBorder(
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(50),
                    bottomLeft: Radius.circular(50),
                  ),
                ),
                side: const BorderSide(
                  color: Colors.grey,
                  width: 0.2,
                ),
                onSelected: (value) => gender.value = 'male',
              ),
              ChoiceChip(
                selected: gender.value == 'female' ? true : false,
                label: Text(AppLocalizations.of(context)!.female),
                padding: const EdgeInsets.symmetric(
                  horizontal: 50,
                  vertical: 16,
                ),
                pressElevation: 0,
                selectedColor: Theme.of(context).colorScheme.primary,
                backgroundColor: Theme.of(context).colorScheme.secondary,
                labelStyle: Theme.of(context).textTheme.titleMedium?.copyWith(
                      color: gender.value == 'female' ? Colors.white : null,
                    ),
                shape: const RoundedRectangleBorder(
                  borderRadius: BorderRadius.only(
                    topRight: Radius.circular(50),
                    bottomRight: Radius.circular(50),
                  ),
                ),
                side: const BorderSide(
                  color: Colors.grey,
                  width: 0.2,
                ),
                onSelected: (value) => gender.value = 'female',
              ),
            ],
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.date_of_birth,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          GestureDetector(
            behavior: HitTestBehavior.opaque,
            onTap: () async {
              final value = await showDatePicker(
                context: context,
                initialDate: DateTime.now(),
                firstDate: DateTime(1900),
                lastDate: DateTime.now(),
              );
              if (value != null) {
                dob.text = DateFormat.yMMMd().format(value);
              }
            },
            child: AbsorbPointer(
              child: TextField(
                controller: dob,
                readOnly: true,
              ),
            ),
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.nid,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          const TextField(readOnly: true, keyboardType: TextInputType.number),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.address,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextField(
            controller: address,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.post_code,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextField(
            controller: postCode,
            keyboardType: TextInputType.number,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
          ),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.city,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextField(
            controller: city,
            onEditingComplete: () => FocusScope.of(context).nextFocus(),
          ),
          const SizedBox(height: 24),
          Text(
            AppLocalizations.of(context)!.contact_details,
            style: Theme.of(context).textTheme.headline6,
          ),
          const SizedBox(height: 16),
          Text(
            AppLocalizations.of(context)!.mobile,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          const TextField(readOnly: true, keyboardType: TextInputType.number),
          const SizedBox(height: 12),
          Text(
            AppLocalizations.of(context)!.email,
            style: Theme.of(context).textTheme.titleMedium,
          ),
          const SizedBox(height: 8),
          TextField(controller: email, keyboardType: TextInputType.number),
          const SizedBox(height: 24),
          PrimaryButton(
            onTap: () {
              if (formKey.currentState?.validate() ?? false) {
                if (onComplete != null) onComplete!();
              }
            },
            text: AppLocalizations.of(context)!.next,
          ),
          const SizedBox(height: 12),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                AppLocalizations.of(context)!.any_queries,
                style: Theme.of(context).textTheme.titleMedium,
              ),
              TextButton(
                onPressed: () {},
                child: Text(
                  AppLocalizations.of(context)!.live_chat,
                  style: Theme.of(context).textTheme.titleLarge?.copyWith(
                        color: Theme.of(context).colorScheme.primary,
                      ),
                ),
              )
            ],
          ),
        ],
      ),
    );
  }
}
